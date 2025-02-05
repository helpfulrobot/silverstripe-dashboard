<?php

abstract class DashboardPanel extends Object {

	protected $controller;

	public function __construct($controller = null) {
		$this->controller = $controller;

		$this->init();
	}

	public function init() {
	}

	public function getData() {
		return array();
	}

	public function forTemplate() {
		if (!$this->canView()) {
			return false;
		}

		$templateName = get_class($this);
		$template = new SSViewer($templateName);

		$data = $this->getData();

		return $template->process(null, $data);
	}

	public function canView($member = null) {
		return Permission::check('CMS_ACCESS_DASHBOARDADMIN');
	}
}
