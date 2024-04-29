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
 *  \file       htdocs/savemail/index.php
 *  \ingroup    savemail
 *  \brief      Page to show product set
 */


$res=@include("../../main.inc.php");                   // For root directory
if (! $res) $res=@include("../../../main.inc.php");    // For "custom" directory


// Libraries
require_once DOL_DOCUMENT_ROOT . "/core/lib/admin.lib.php";
require_once DOL_DOCUMENT_ROOT.'/core/lib/functions2.lib.php';

dol_include_once("/savemail/lib/savemail.lib.php");

// Translations
$langs->load("savemail@savemail");

// Translations
$langs->load("errors");
$langs->load("admin");
$langs->load("other");

// Access control
if (! $user->admin) {
    accessforbidden();
}

$versions = array(
    array('version' => '1.0.0', 'date' => '29/04/2024', 'updates' => $langs->trans('SaveMailFirstVersion')),
);
/*
 * View
 */

$form = new Form($db);

llxHeader('', $langs->trans('SaveMailAbout'));

// Subheader
$linkback = '<a href="' . DOL_URL_ROOT . '/admin/modules.php">'. $langs->trans("BackToModuleList") . '</a>';
print load_fiche_titre($langs->trans('SaveMailAbout'), $linkback);

// Configuration header
$head = savemail_prepare_admin_head();
dol_fiche_head(
    $head,
    'about',
    $langs->trans("ModuleSaveMailName"),
    0,
    'savemail@savemail'
);

// About page goes here
echo $langs->trans("SaveMailAboutPage");

echo '<br />';

print '<h2>'.$langs->trans("About").'</h2>';
print $langs->trans("SaveMailAboutDescLong");

print '<hr />';
print '<h2>'.$langs->trans("SaveMailChangeLog").'</h2>';


print '<table class="noborder" width="100%">';
print '<tr class="liste_titre">';
print '<td>'.$langs->trans("SaveMailChangeLogVersion").'</td>';
print '<td>'.$langs->trans("SaveMailChangeLogDate").'</td>';
print '<td>'.$langs->trans("SaveMailChangeLogUpdates").'</td>';
print "</tr>\n";

foreach ($versions as $version)
{
    print '<tr class="oddeven">';
    print '<td>';
    print $version['version'];
    print '</td>';
    print '<td>';
    print $version['date'];
    print '</td>';
    print '<td>';
    print $version['updates'];
    print '</td>';
    print '</tr>';
}


print '</table>';

// Page end
dol_fiche_end();
llxFooter();
$db->close();
