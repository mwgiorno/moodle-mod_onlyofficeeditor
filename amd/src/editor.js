// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @module mod_onlyofficeeditor/editor
 * @copyright  2022 Ascensio System SIA <integration@onlyoffice.com>
 * @copyright  based on work by 2018 Olumuyiwa Taiwo <muyi.taiwo@logicexpertise.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 **/
define(['jquery'], function($) {
    var displayNotification = function(error, type) {
        require(['core/notification'], function(notification) {
            require(['core/str'], function(str) {
                var errorIsAvailable = str.get_string(error, 'onlyofficeeditor');
                $.when(errorIsAvailable).done(function(localizedStr) {
                    notification.addNotification({
                        message: localizedStr,
                        type: type
                    });
                });
            });
        });
    };

    var saveAsModal = null;

    var displaySaveAsModal = function(saveAsData, cmid, courseid) {
        require(['jquery', 'core/templates', 'core/modal_factory', 'mod_onlyofficeeditor/modal_saveas'],
            function($, Templates, ModalFactory, ModalSaveas) {
                var trigger = $('.onlyofficeeditor-container');
                if (saveAsModal === null) {
                    saveAsModal = ModalFactory.create({
                        type: ModalSaveas.TYPE
                    }, trigger);
                }
                saveAsModal.then((modal) => {
                    modal.courseid = courseid;
                    modal.CMID = cmid;
                    modal.saveAsData = saveAsData;
                });
                saveAsModal.done((modal) => {
                    modal.renderSections(modal.getBody(), cmid, courseid);
                    modal.show();
                });
            });
    };

    return {
        init: function(courseid, cmid) {
            if (typeof DocsAPI === "undefined") {
                displayNotification('docserverunreachable', 'error');
                return;
            }
            var ajaxUrl = M.cfg.wwwroot + '/mod/onlyofficeeditor/dsconfig.php';
            $.getJSON(ajaxUrl, {
                courseid: courseid,
                cmid: cmid
            }).done(function(data) {
                var docEditor = null;
                var config = data.config;
                var canAddInstance = data.addinstance;

                const innerAlert = (message, inEditor) => {
                    // eslint-disable-next-line no-console
                    if (console && console.log) {
                        // eslint-disable-next-line no-console
                        console.log(message);
                    }
                    if (inEditor && docEditor) {
                        docEditor.showMessage(message);
                    }
                };
                const onAppReady = () => {
                    innerAlert("Document editor ready");
                };

                const onError = (event) => {
                    if (event) {
                        innerAlert(event.data);
                    }
                };
                config.events = {
                    'onAppReady': onAppReady,
                    'onError': onError
                };

                var onRequestSaveAs = function(event) {
                    var saveAsData = {
                        title: event.data.title,
                        url: event.data.url,
                        courseid: courseid,
                        section: null
                    };
                    displaySaveAsModal(saveAsData, cmid, courseid);
                };

                if (canAddInstance) {
                    config.events.onRequestSaveAs = onRequestSaveAs;
                }

                if ((config.document.fileType === "docxf" || config.document.fileType === "oform")
                    // eslint-disable-next-line no-undef
                    && DocsAPI.DocEditor.version().split(".")[0] < 7) {
                    displayNotification('oldversion', 'error');
                } else {
                    // eslint-disable-next-line no-undef
                    docEditor = new DocsAPI.DocEditor("onlyofficeeditor-editor", config);
                }
            });
        }
    };
});
