<?php
class BusinessDao extends LotusyDaoBase {

	const USERID = 'user_id';
	const NAMEZH = 'name_zh';
	const NAMETW = 'name_tw';
	const NAMEEN = 'name_en';
	const IMAGE = 'image';
	const STREET = 'street';
	const CITY = 'city';
	const STATE = 'state';
	const COUNTRY = 'country';
	const ZIP = 'zip';
	const LAT = 'lat';
	const LNG = 'lng';
	const PRICE = 'price';
	const HOURS = 'hours';
	const CASHONLY = 'cash_only';
	const VERRFIED = 'verified';
	const TEL = 'tel';
	const WEBSITE = 'website';
	const SOCIAL = 'social';

	const IDCOLUMN = 'id';
	const SHARDDOMAIN = 'business';
	const TABLE = 'business';
	const ODBNAME = 'business';


// =========================================================================================================== public

	public static function getBusinessIdsByName($name, $field) {
		$lookup = null;
		$table = '';
		$bid = '';
		$column = '';

		switch ($field) {
			case BusinessDao::NAMEEN:
				$lookup = new LookupBusinessEnNameDao();
				$table = LookupBusinessEnNameDao::TABLE;
				$bid = LookupBusinessEnNameDao::BUSINESSID;
				$column = LookupBusinessEnNameDao::ENNAME;
				break;
			case BusinessDao::NAMETW:
				$lookup = new LookupBusinessTwNameDao();
				$table = LookupBusinessTwNameDao::TABLE;
				$bid = LookupBusinessTwNameDao::BUSINESSID;
				$column = LookupBusinessTwNameDao::TWNAME;
				break;
			case BusinessDao::NAMEZH:
				$lookup = new LookupBusinessZhNameDao();
				$table = LookupBusinessZhNameDao::TABLE;
				$bid = LookupBusinessZhNameDao::BUSINESSID;
				$column = LookupBusinessZhNameDao::ZHNAME;
				break;
			default:
				return array();
				break;
		}

		$lookup->setServerAddress( Utility::hashString($name) );

		$sql = "SELECT $bid FROM $table WHERE $column LIKE '%$name%'";

		$connect = DBUtil::getConn($lookup);
		$rows = DBUtil::selectDataList($connect, $sql);

		$atReturn = array();
		foreach ($rows as $row) {
			array_push($atReturn, $row[$bid]);
		}

		return $atReturn;
	}

// ============================================ override functions ==================================================

	protected function init() {
		global $base_image_host;
		$this->var[BusinessDao::USERID] = 0;
		$this->var[BusinessDao::NAMEZH] = '';
		$this->var[BusinessDao::NAMETW] = '';
		$this->var[BusinessDao::NAMEEN] = '';
		$this->var[BusinessDao::IMAGE] = '';
		$this->var[BusinessDao::STREET] = '';
		$this->var[BusinessDao::CITY] = '';
		$this->var[BusinessDao::STATE] = '';
		$this->var[BusinessDao::COUNTRY] = '';
		$this->var[BusinessDao::ZIP] = '';
		$this->var[BusinessDao::LAT] = '';
		$this->var[BusinessDao::LNG] = '';
		$this->var[BusinessDao::PRICE] = '';
		$this->var[BusinessDao::HOURS] = '';
		$this->var[BusinessDao::CASHONLY] = '';
		$this->var[BusinessDao::VERRFIED] = '';
		$this->var[BusinessDao::TEL] = '';
		$this->var[BusinessDao::WEBSITE] = '';
		$this->var[BusinessDao::SOCIAL] = '';
	}

	protected function beforeInsert() {
		$lookup = new LookupBusinessLocationDao();
		$lookup->var[LookupBusinessLocationDao::LAT] = $this->var[BusinessDao::LAT];
		$lookup->var[LookupBusinessLocationDao::LNG] = $this->var[BusinessDao::LNG];
		$lookup->var[LookupBusinessLocationDao::BUSINESSID] = $this->var[BusinessDao::IDCOLUMN];
		$lookup->var[LookupBusinessLocationDao::VERIFIED] = $this->var[BusinessDao::VERRFIED];
		$lookup->save();

		$lookup = new LookupBusinessUserDao();
		$lookup->var[LookupBusinessUserDao::USERID] = $this->var[BusinessDao::USERID];
		$lookup->var[LookupBusinessUserDao::BUSINESSID] = $this->var[BusinessDao::IDCOLUMN];
		$lookup->save();

		$lookup = new LookupBusinessZhNameDao();
		$lookup->var[LookupBusinessZhNameDao::ZHNAME] = $this->var[BusinessDao::NAMEZH];
		$lookup->var[LookupBusinessZhNameDao::BUSINESSID] = $this->var[BusinessDao::IDCOLUMN];
		$lookup->save();

		$lookup = new LookupBusinessTwNameDao();
		$lookup->var[LookupBusinessTwNameDao::TWNAME] = $this->var[BusinessDao::NAMETW];
		$lookup->var[LookupBusinessTwNameDao::BUSINESSID] = $this->var[BusinessDao::IDCOLUMN];
		$lookup->save();

		$lookup = new LookupBusinessEnNameDao();
		$lookup->var[LookupBusinessEnNameDao::ENNAME] = $this->var[BusinessDao::NAMEEN];
		$lookup->var[LookupBusinessEnNameDao::BUSINESSID] = $this->var[BusinessDao::IDCOLUMN];
		$lookup->save();
	}

    protected function beforeUpdate() {
    	$lookup = LookupBusinessLocationDao::getLookupWithBusiness($this);
    	if ($this->var[BusinessDao::VERRFIED]!=$lookup->var[LookupBusinessLocationDao::VERIFIED]) {
    		$lookup->var[LookupBusinessLocationDao::VERIFIED] = $this->var[BusinessDao::VERRFIED];
    		$lookup->save();
    	}
    }

	protected function getTableName() {
		return BusinessDao::TABLE;
	}

	protected function getIdColumnName() {
		return BusinessDao::IDCOLUMN;
	}

	public function getShardDomain() {
		return BusinessDao::SHARDDOMAIN;
	}

	protected function getOriginalDatabaseName() {
		return BusinessDao::ODBNAME;
	}

	protected function isShardBaseObject() {
		return true;
	}
}
?>