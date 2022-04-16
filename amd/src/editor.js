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

/* @package    mod_onlyofficeeditor
 * @copyright  2022 Ascensio System SIA <integration@onlyoffice.com>
 * @copyright  based on work by 2018 Olumuyiwa Taiwo <muyi.taiwo@logicexpertise.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


define(['jquery'], function($) {
    var displayError = function(error) {
        require(['core/notification'], function(notification) {
            require(['core/str'], function(str) {
                var errorIsAvailable = str.get_string(error, 'onlyofficeeditor');
                $.when(errorIsAvailable).done(function(localizedStr) {
                    notification.addNotification({
                        message: localizedStr,
                        type: 'error'
                    });
                });
            });
        });
    };

    $.urlParam = function(name) {
        var results = new RegExp('[\\?&]' + name + '=([^&#]*)').exec(window.location.href);
        if (results === null) {
            return null;
        }
        return decodeURI(results[1]) || 0;
    };

    var replaceActionLink = function(href, linkParam) {
        var link;
        var actionIndex = href.indexOf("&actionType=");
        if (actionIndex != -1) {
            link = href.substring(0, actionIndex) + "&actionType=" + encodeURIComponent(linkParam.type) +
                "&actionData=" + encodeURIComponent(linkParam.data);
        } else {
            link = href + "&actionType=" + encodeURIComponent(linkParam.type) + "&actionData=" + encodeURIComponent(linkParam.data);
        }
        return link;
    };

    return {
        init: function(courseid, cmid) {
            if (typeof DocsAPI === "undefined") {
                displayError('docserverunreachable');
                return;
            }
            var ajaxUrl = M.cfg.wwwroot + '/mod/onlyofficeeditor/dsconfig.php';
            $.getJSON(ajaxUrl, {
                courseid: courseid,
                cmid: cmid,
                actionType: $.urlParam('actionType'),
                actionData: $.urlParam('actionData')
            }).done(function(data) {
                let config = data.config;

                var onMakeActionLink = function(event) {
                    var actionData = event.data.action;
                    docEditor.setActionLink(replaceActionLink(location.href, actionData));
                };
                config.events = {
                    'onMakeActionLink': onMakeActionLink
                };

                var onRequestUsers = function() {
                    docEditor.setUsers({'users': usersToMention});
                };

                var onRequestSendNotify = function(event) {
                    var comment = event.data.message;
                    var emails = event.data.emails;
                    var replacedActionLink = replaceActionLink(location.href, event.data.actionLink.action);

                    var mentionData = {
                        comment: comment,
                        emails: emails,
                        link: replacedActionLink,
                        courseid: courseid
                    };

                    $.ajax(M.cfg.wwwroot + '/mod/onlyofficeeditor/onlyofficeeditorapi.php?apiType=mention&cmid=' + cmid, {
                        type: 'POST',
                        dataType: 'json',
                        data: mentionData
                    }).fail(() => {
                        displayError('onmentionerror');
                    });
                };

                var usersToMention = data.userstomention;
                if (usersToMention !== null) {
                    config.events.onRequestUsers = onRequestUsers;
                    config.events.onRequestSendNotify = onRequestSendNotify;
                }

                // eslint-disable-next-line no-undef
                var docEditor = new DocsAPI.DocEditor("onlyofficeeditor-editor", config);
            });
        }
    };
});
