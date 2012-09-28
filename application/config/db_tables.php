<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

$config['db_tables'] = array(
	'auth_modules' => array(
		'MODULE_ID',
		'MODULE_CODE',
		'MODULE_NAME',
		'MODULE_SINGLE_LABEL',
		'MODULE_PLURAL_LABEL',
		'PARENT_ID',
		'MODULE_URL',
		'ACTIVE',
		'SHOW_IN_MENU',
		'SHOW_IN_FORM',
		'SEQUENCE_NUMBER'
	),
	'auth_ug_module_relationship' => array(
		'MODULE_ID',
		'GROUP_ID'
	),
	'auth_ug_user_relationship' => array(
		'GROUP_ID',
		'USER_ID'
	),
	'auth_user_groups' => array(
		'GROUP_ID',
		'GROUP_NAME',
		'ACTIVE'
	),
	'ci_sessions' => array(
		'session_id',
		'ip_address',
		'user_agent',
		'last_activity',
		'user_data'
	),
	'cities' => array(
		'CITY_ID',
		'CITY_NAME',
		'COUNTRY_ID',
		'STATE_ID'
	),
	'companies' => array(
		'COMPANY_ID',
		'COMPANY_NAME',
		'EMAIL',
		'PHONE',
		'FAX',
		'WEBSITE',
		'ADDRESS',
		'COUNTRY_ID',
		'STATE_ID',
		'CITY_ID',
		'ZIP_CODE_ID'
	),
	'countries' => array(
		'COUNTRY_ID',
		'COUNTRY_NAME'
	),
	'courts' => array(
		'COURT_ID',
		'COURT_NAME',
		'LAW_TYPE_ID',
		'COUNTRY_ID',
		'MAILING_STATE_ID',
		'MAILING_CITY_ID',
		'MAILING_ZIP_CODE_ID',
		'MAILING_ADDRESS',
		'STREET_STATE_ID',
		'STREET_CITY_ID',
		'STREET_ZIP_CODE_ID',
		'STREET_ADDRESS',
		'BRANCH',
		'DIVISION',
		'DEPARTMENT',
		'EMAIL',
		'PHONE1',
		'PHONE2',
		'PHONE3',
		'FAX'
	),
	'email_sendings' => array(
		'EMAIL_ID',
		'MATTER_ID',
		'USER_ID',
		'EMAIL_TO',
		'EMAIL_CC',
		'EMAIL_BCC',
		'EMAIL_BODY',
		'SUCCESSFUL',
		'INSERTER_ID',
		'INSERT_DATE'
	),
	'event_categories' => array(
		'CATEGORY_ID',
		'CATEGORY_NAME',
		'CATEGORY_COLOR',
		'ICON_PATH'
	),
	'events' => array(
		'EVENT_ID',
		'CATEGORY_ID',
		'EVENT_DATETIME',
		'END_DATETIME',
		'DESCRIPTION',
		'LOCATION_ID',
		'WITH_ID',
		'MATTER_ID',
		'PRIORITY_ID',
		'EVENT_STATUS_ID',
		'PRIVATE',
		'REMINDER1_WITH',
		'REMINDER1_DATE',
		'REMINDER2_WITH',
		'REMINDER2_DATE',
		'REMINDER3_WITH',
		'REMINDER3_DATE',
		'INSERTER_ID',
		'INSERT_DATE',
		'UPDATER_ID',
		'UPDATE_DATE'
	),
	'locations' => array(
		'LOCATION_ID',
		'LOCATION_NAME'
	),
	'matter_doc_status' => array(
		'DOC_STATUS_ID',
		'DOC_STATUS_NAME'
	),
	'matter_doc_types' => array(
		'DOC_TYPE_ID',
		'DOC_TYPE_NAME',
		'IS_ACTIVE'
	),
	'matter_documents' => array(
		'DOC_ID',
		'DOC_PATH',
		'DOC_NAME',
		'MATTER_ID',
		'CLIENT_ID',
		'DOC_TYPE_ID',
		'AUTHOR',
		'DOC_STATUS_ID',
		'DESCRIPTION',
		'INSERTER_ID',
		'INSERT_DATE',
		'UPDATER_ID',
		'UPDATE_DATE'
	),
	'matter_exhibit_status' => array(
		'EXHIBIT_STATUS_ID',
		'EXHIBIT_STATUS_NAME'
	),
	'matter_exhibit_types' => array(
		'EXHIBIT_TYPE_ID',
		'EXHIBIT_TYPE_NAME',
		'IS_ACTIVE'
	),
	'matter_exhibits' => array(
		'EXHIBIT_ID',
		'EXHIBIT_TYPE_ID',
		'MATTER_ID',
		'CLIENT_ID',
		'EXHIBIT_DOX_ID',
		'ACQUIRED_DATE',
		'DEPOSITION_NUMBER',
		'TRIAL_NUMBER',
		'OFFERING_PARTY',
		'DESCRIPTION',
		'BATES_BEGIN',
		'BATES_END',
		'AUTHOR',
		'SIGNATORY',
		'IDENTIFIED_DATE',
		'ADMITTED_DATE',
		'IS_KEY_EXHIBIT',
		'EXHIBIT_STATUS_ID',
		'VALUE_ID',
		'ANALYSIS',
		'INSERTER_ID',
		'INSERT_DATE',
		'UPDATER_ID',
		'UPDATE_DATE'
	),
	'matter_fact_status' => array(
		'FACT_STATUS_ID',
		'FACT_STATUS_NAME'
	),
	'matter_fact_types' => array(
		'FACT_TYPE_ID',
		'FACT_TYPE_NAME',
		'IS_ACTIVE'
	),
	'matter_facts' => array(
		'FACT_ID',
		'FACT_TYPE_ID',
		'MATTER_ID',
		'CLIENT_ID',
		'DATE',
		'DESCRIPTION',
		'SOURCE',
		'ISSUE',
		'AUTHOR',
		'SIGNATORY',
		'IS_KEY_FACT',
		'FACT_STATUS_ID',
		'VALUE_ID',
		'ANALYSIS',
		'INSERTER_ID',
		'INSERT_DATE',
		'UPDATER_ID',
		'UPDATE_DATE'
	),
	'matter_linked_client_types' => array(
		'LINKED_TYPE_ID',
		'LINKED_TYPE_NAME',
		'IS_ACTIVE'
	),
	'matter_linked_clients' => array(
		'LINKED_ID',
		'LINK_TYPE_ID',
		'MATTER_ID',
		'CLIENT_ID',
		'DESCRIPTION',
		'INSERTER_ID',
		'INSERT_DATE',
		'UPDATER_ID',
		'UPDATE_DATE'
	),
	'matter_note_types' => array(
		'NOTE_TYPE_ID',
		'NOTE_TYPE_NAME',
		'IS_ACTIVE'
	),
	'matter_notes' => array(
		'NOTE_ID',
		'NOTE_TYPE_ID',
		'NOTE_DATE',
		'DESCRIPTION',
		'PHONE',
		'MINUTE',
		'MATTER_ID',
		'CLIENT_ID',
		'OPERATOR_ID',
		'IS_PRIVATE',
		'INSERTER_ID',
		'INSERT_DATE',
		'UPDATER_ID',
		'UDPATE_DATE'
	),
	'matter_types' => array(
		'MATTER_TYPE_ID',
		'MATTER_TYPE_NAME',
		'IS_ACTIVE'
	),
	'matters' => array(
		'MATTER_ID',
		'MATTER_TYPE_ID',
		'UNIQUE_KEY',
		'MATTER_NAME',
		'SUBJECT',
		'FILE_OR_CASE_NUMBER',
		'ATTORNEY_ID',
		'COURT_ID',
		'DESCRIPTION',
		'OPEN_DATE',
		'CLOSE_DATE',
		'IS_CLOSED',
		'INSERTER_ID',
		'INSERT_DATE',
		'UPDATER_ID',
		'UPDATE_DATE'
	),
	'options' => array(
		'OPTION_ID',
		'OPTION_NAME',
		'OPTION_VALUE',
		'AUTOLOAD',
		'LANGUAGE_ID'
	),
	'sample' => array(
		'COUNTRY_ID',
		'COUNTRY_NAME',
		'COUNTRY_SEO',
		'INSERT_DATE'
	),
	'states' => array(
		'STATE_ID',
		'STATE_NAME',
		'COUNTRY_ID'
	),
	'status' => array(
		'STATUS_ID',
		'STATUS_NAME',
		'IS_ACTIVE',
		'STATUS_TYPE'
	),
	'user_notes' => array(
		'NOTE_ID',
		'USER_ID',
		'NOTE_TITLE',
		'NOTE_BODY',
		'INSERT_DATE'
	),
	'user_types' => array(
		'USER_TYPE_ID',
		'USER_TYPE_NAME',
		'ACTIVE'
	),
	'users' => array(
		'USER_ID',
		'USER_TYPE_ID',
		'ADMIN_TYPE_ID',
		'IS_ADMIN',
		'UNIQUE_KEY',
		'USERNAME',
		'NAME_PREFIX',
		'FIRST_NAME',
		'MIDDLE_NAME',
		'LAST_NAME',
		'MAIDEN_NAME',
		'FULL_NAME',
		'EMAIL',
		'WEBSITE',
		'COMPANY_ID',
		'HOME_PHONE',
		'WORK_PHONE',
		'DAY_PHONE',
		'EVENING_PHONE',
		'MOBILE',
		'FAX',
		'ADDRESS',
		'GENDER',
		'COUNTRY_ID',
		'STATE_ID',
		'CITY_ID',
		'ZIP_CODE_ID',
		'ATTORNEY_ID',
		'DATE_OF_RECORD',
		'REFERRED_BY',
		'ACTIVE',
		'INSERTER_ID',
		'INSERT_DATE',
		'UPDATER_ID',
		'UPDATE_DATE',
		'HEIGHT',
		'WEIGHT',
		'HAIR_COLOR',
		'EYE_COLOR',
		'DATE_OF_BIRTH',
		'BIRTH_COUNTRY',
		'BIRTH_STATE',
		'BIRTH_CITY',
		'NATIONALITY',
		'RACE',
		'SSN',
		'PASSPORT',
		'PASSPORT_COUNTRY_ID',
		'DATE_PASSPORT_EXPIRES',
		'MARITAL_STATUS_ID',
		'PREVIOUS_MARRIAGES_COUNT',
		'DATE_MARRIED',
		'PLACE_MARRIED'
	),
	'zip_codes' => array(
		'ZIP_CODE_ID',
		'ZIP_CODE',
		'AREA_CODE',
		'COUNTRY_ID',
		'STATE_ID',
		'CITY_ID'
	)
);