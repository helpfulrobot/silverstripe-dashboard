<?php

class QuickLinksPanel extends DashboardPanel {

	public function canView($member = null) {
		$data = $this->getData();
		if (!$data['CanView']) {
			return false;
		}

		return parent::canView($member);
	}

	public function init() {
		parent::init();
		Requirements::css(DASHBOARD_ADMIN_DIR . '/css/dashboard-quick-links-panel.css');
	}

	public function getData() {
		$data = parent::getData();

		$data['CanView'] = false;

		$data['CanViewPages'] = Permission::check('CMS_ACCESS_CMSMain') && class_exists('CMSPagesController');
		$data['CanView'] = $data['CanView'] || $data['CanViewPages'];
		$data['CanViewUsers'] = Permission::check('CMS_ACCESS_SecurityAdmin') && class_exists('SecurityAdmin');
		$data['CanView'] = $data['CanView'] || $data['CanViewUsers'];
		$data['CanViewSettings'] = Permission::check('EDIT_SITECONFIG') && class_exists('SiteConfigLeftAndMain');
		$data['CanView'] = $data['CanView'] || $data['CanViewSettings'];
		$data['CanViewRedirects'] = Permission::check('CMS_ACCESS_MisdirectionAdmin') && class_exists('MisdirectionAdmin');
		$data['CanView'] = $data['CanView'] || $data['CanViewRedirects'];

		$this->extend('updateData', $data);

		return $data;
	}
}
