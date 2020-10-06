<?php
/**
 * @package	AcyMailing for Joomla
 * @version	6.3.1
 * @author	acyba.com
 * @copyright	(C) 2009-2019 ACYBA S.A.R.L. All rights reserved.
 * @license	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

defined('_JEXEC') or die('Restricted access');
?><form id="acym_form" enctype="multipart/form-data" action="<?php echo acym_completeLink(acym_getVar('cmd', 'ctrl')); ?>" method="post" name="acyForm">
	<div class="acym__content acym__content__tab">
        <?php
        $data['tab']->startTab(acym_translation('ACYM_IMPORT_FROM_FILE'));
        include(dirname(__FILE__).DS.'importfromfile.php');
        $data['tab']->endTab();

        $data['tab']->startTab(acym_translation('ACYM_IMPORT_FROM_TEXT'));
        include(dirname(__FILE__).DS.'importfromtext.php');
        $data['tab']->endTab();

        $data['tab']->startTab(acym_translation_sprintf('ACYM_CMS_USERS', ACYM_CMS_TITLE));
        include(dirname(__FILE__).DS.'importcmsusers.php');
        $data['tab']->endTab();

        $data['tab']->startTab(acym_translation('ACYM_DATABASE'));
        include(dirname(__FILE__).DS.'importfromdatabase.php');
        $data['tab']->endTab();

        $data['tab']->display('import');
        ?>
	</div>
    <?php
    $entityHelper = acym_get('helper.entitySelect');
    echo acym_modal(
        acym_translation('ACYM_IMPORT_USERS'),
        $entityHelper->entitySelect('list', ['join' => ''], ['name', 'id'], ['text' => acym_translation('ACYM_IMPORT_USERS'), 'class' => 'acym__users__import__button']),
        'acym__user__import__add-subscription__modal',
        '',
        'style="display: none"'
    );

    ?>
	<input type="hidden" name="import_from" />
    <?php acym_formOptions(true, "doImport"); ?>
</form>

