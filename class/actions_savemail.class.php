<?php
/* Copyright (C) 2004-2017 Laurent Destailleur  <eldy@users.sourceforge.net>
 * Copyright (C) 2017 Mikael Carlavan <contact@mika-carl.fr>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 *  \file       htdocs/savemail/class/actions_savemail.class.php
 *  \ingroup    savemail
 *  \brief      File of class to manage actions
 */
require_once DOL_DOCUMENT_ROOT . '/core/class/commonobject.class.php';
require_once DOL_DOCUMENT_ROOT . '/core/class/html.form.class.php';
require_once DOL_DOCUMENT_ROOT . '/user/class/usergroup.class.php';
require_once DOL_DOCUMENT_ROOT . '/comm/action/class/actioncomm.class.php';
require_once DOL_DOCUMENT_ROOT . '/contact/class/contact.class.php';
require_once DOL_DOCUMENT_ROOT . '/societe/class/societe.class.php';
require_once DOL_DOCUMENT_ROOT . '/categories/class/categorie.class.php';
require_once DOL_DOCUMENT_ROOT . '/user/class/usergroup.class.php';
require_once DOL_DOCUMENT_ROOT . '/core/lib/files.lib.php';
require_once DOL_DOCUMENT_ROOT . '/projet/class/project.class.php';


class ActionsSaveMail
{
    function sendMail($parameters, &$object, &$action, $hookmanager)
    {
        global $langs, $db, $mysoc, $conf, $user;

        $trackid = $object->trackid;

        if (strpos($trackid, 'proj') !== false) {
            $objectid = str_replace('proj', '', $trackid);
            $project = new Project($db);
            $project->fetch($objectid);

            if ($project->id > 0) {
                if (is_array($object->filename_list) && count($object->filename_list)) {
                    foreach ($object->filename_list as $file) {
                        $upload_dir = $conf->project->multidir_output[$project->entity]."/".dol_sanitizeFileName($project->ref);
                        if (file_exists($file)) {
                            $destfile = $upload_dir.'/'.basename($file);
                            @dol_copy($file, $destfile);
                        }
                    }
                }
            }
        }

        return 0;
    }
}


