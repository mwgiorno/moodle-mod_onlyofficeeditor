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
        require(['core/str'], function(str) {
            var errorIsAvailable = str.get_string(error, 'onlyofficeeditor');
            $.when(errorIsAvailable).done(function(localizedStr) {
                $("#onlyofficeeditor-editor").text = localizedStr;
                $("#onlyofficeeditor-editor").text(localizedStr).addClass("error");
            });
        });
    };

    var createFullScreenButtons = function() {
        require(['core/str'], function(str) {
            var enterFullScreenText = str.get_string('editorenterfullscreen', 'onlyoffice');
            var exitFullScreenText = str.get_string('editorexitfullscreen', 'onlyoffice');
            var navButton = $('nav .nav-link.btn')[0];
            var editorContainer = $('.onlyoffice-container')[0];

            $.when(enterFullScreenText).done(function(localized) {
                enterFullScreenText = localized;
                var enterButton = document.createElement('button');
                var enterIcon = document.createElement('i');
                enterIcon.className = 'icon fa fa-expand fa-fw';
                enterButton.appendChild(enterIcon);
                enterButton.className = 'onlyoffice-editor-fs-button';
                enterButton.id = 'onlyoffice-enter-fs-button';
                enterButton.innerHTML += enterFullScreenText;
                enterButton.style.cssText = 'padding: 5px; margin-top: -5px; margin-right: 10px;';

                enterButton.onclick = function() {
                    $('header').hide();
                    $('footer').hide();
                    if (navButton.getAttribute('aria-expanded') === 'true') {
                        $('nav .nav-link.btn')[0].click();
                    }
                    editorContainer.style.cssText = 'position: absolute; left: 0; right: 0; top: 0; ' +
                        'padding: 0 16px 0 16px; z-index: 100;';
                    $('#onlyoffice-enter-fs-button').hide();
                    $('#onlyoffice-exit-fs-button').show();
                };
                $("#region-main-settings-menu .menubar")[0].prepend(enterButton);
            });
            $.when(exitFullScreenText).done(function(localized) {
                exitFullScreenText = localized;
                var exitButton = document.createElement('button');
                var exitIcon = document.createElement('i');
                exitIcon.className = 'icon fa fa-compress fa-fw';
                exitButton.appendChild(exitIcon);
                exitButton.innerHTML += exitFullScreenText;
                exitButton.className = 'onlyoffice-editor-fs-button';
                exitButton.id = 'onlyoffice-exit-fs-button';

                exitButton.onclick = function() {
                    editorContainer.style.cssText = '';
                    $('header').show();
                    $('footer').show();
                    $('#onlyoffice-enter-fs-button').show();
                    $('#onlyoffice-exit-fs-button').hide();
                };
                $('.usernav .nav-item')[0].prepend(exitButton);
                $('#onlyoffice-exit-fs-button').hide();
            });
        });
    };

    return {
        init: function(courseid, cmid) {
            if (typeof DocsAPI === "undefined") {
                displayError('docserverunreachable');
                return;
            }
            createFullScreenButtons();
            var ajaxUrl = M.cfg.wwwroot + '/mod/onlyofficeeditor/dsconfig.php';
            $.getJSON(ajaxUrl, {
                courseid: courseid,
                cmid: cmid
            }).done(function(config) {
                var favicon = config.documentType;
                if (config.fileType === 'docxf' || config.fileType === 'oform') {
                    favicon = config.fileType;
                }
                document.head.innerHTML += '<link type="image/x-icon" rel="icon" href="/mod/onlyofficeeditor/pix/'
                    + favicon + '.ico" />';
                // eslint-disable-next-line no-undef
                new DocsAPI.DocEditor("onlyofficeeditor-editor", config);
            });
        }
    };
});
