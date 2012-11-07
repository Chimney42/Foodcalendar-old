<?php

class CalendarController {

    protected function _renderOverview($notifications = array()) {
        include 'Calendar/CalendarView.php';
    }

    public function indexAction() {
        $this->_renderOverview();
    }

    public function generateAction() {
        $profileMapper = new ProfileMapper;
        if (isset($_POST['submit'])) {
            $profileID = $_POST['profileID'];
            $startCheck = checkdate((int)$_POST['startMonth'], (int)$_POST['startDay'], (int)$_POST['startYear']);
            $endCheck = checkdate((int)$_POST['endMonth'], (int)$_POST['endDay'], (int)$_POST['endYear']);
            if ($startCheck === false) {
                $this->_renderOverview(array('Invalid Startdate'));
                return;
            }
            if ($endCheck === false) {
                $this->_renderOverview(array('Invalid Enddate'));
                return;
            }
            $startDate = (int)$_POST['startYear'] . '-' . (int)$_POST['startMonth'] . '-' . (int)$_POST['startDay'];
            $endDate = (int)$_POST['endYear'] . '-' . (int)$_POST['endMonth'] . '-' . (int)$_POST['endDay'];

            try {
                $startDate = new DateTime($startDate);
                $endDate = new Datetime($endDate);
                $date = new Date;
                $timespan = $date->getTimespan($startDate, $endDate);
            } catch (Exception $e) {
                echo $e->getMessage();
                exit();
            }

            $criteriaMapper = new CriteriaMapper;
            $entries = $criteriaMapper->select(array('ProfileCriteria.profileID'=>$profileID, 'ProfileCriteria.criteriaID'=>'Criteria.ID'), array(), array('Criteria', 'ProfileCriteria'));
            $searchCriteria = array();
            foreach ($entries as $entry) {
                $criterion = $entry->getCriterion();
                $operator = $entry->getOperator();
                $value = $entry->getValue();

            }

        } elseif (isset($_POST['cancel'])) {
            $this->_renderOverview();
        } else {
            $profiles = $profileMapper->select(array());
            $this->_renderOverview();
            include 'Calendar/generateCalendar.php';
        }
    }
}