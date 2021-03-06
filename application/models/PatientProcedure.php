<?php
/*****************************************************************************
*       PatientProcedure.php
*
*       Author:  ClearHealth Inc. (www.clear-health.com)        2009
*       
*       ClearHealth(TM), HealthCloud(TM), WebVista(TM) and their 
*       respective logos, icons, and terms are registered trademarks 
*       of ClearHealth Inc.
*
*       Though this software is open source you MAY NOT use our 
*       trademarks, graphics, logos and icons without explicit permission. 
*       Derivitive works MUST NOT be primarily identified using our 
*       trademarks, though statements such as "Based on ClearHealth(TM) 
*       Technology" or "incoporating ClearHealth(TM) source code" 
*       are permissible.
*
*       This file is licensed under the GPL V3, you can find
*       a copy of that license by visiting:
*       http://www.fsf.org/licensing/licenses/gpl.html
*       
*****************************************************************************/


class PatientProcedure extends WebVista_Model_ORM {

	protected $code;
	protected $patientId;
	protected $providerId;
	protected $quantity;
	protected $procedure;
	protected $modifiers;
	protected $comments;
	protected $dateTime;

	protected $_primaryKeys = array('code','patientId');
	protected $_table = 'patientProcedures';

	const ENUM_PARENT_NAME = 'Procedure Preferences';

	public function persist() {
		if (!$this->dateTime || $this->dateTime == '0000-00-00 00:00:00') {
			$this->dateTime = date('Y-m-d H:i:s');
		}
		return parent::persist();
	}

	public function getPatientProcedureId() {
		return $this->code;
	}

	public function getIteratorByPatientId($patientId=null) {
		if ($patientId === null) $patientId = $this->patientId;
		$db = Zend_Registry::get('dbAdapter');
		$sqlSelect = $db->select()
				->from($this->_table)
				->where('patientId = ?',(int)$patientId);
		return new PatientProcedureIterator($sqlSelect);
	}

}
