<!-- dummy service -->
<?php
	include "database.php";

	function fetchRegions() {
		$db = new MySqlDatabase();
		$sql = "SELECT DISTINCT(Region) as 'Region' FROM wdi2.country ORDER BY Region";
		//$rows = $db->select($sql);
		// $db->close();

		$rows = $db->query($sql);

		return $rows;
	}

	function fetchData() {
		$db = new MySqlDatabase();
		$sql = "SELECT Id, CountryCode, SeriesCode, YearC, Data FROM wdi2.databyyear ORDER BY CountryCode LIMIT 20";
		$rows = $db->select($sql);
		// $db->close();

		return $rows;
	}

	function fetchDataFilterRegion($region) {
		$db = new MySqlDatabase();
		$sql = "SELECT D.Id, D.CountryCode, D.SeriesCode, D.YearC, D.Data FROM wdi2.databyyear D, wdi2.country C WHERE D.CountryCode = C.CountryCode AND C.Region = '" . $region . "' ORDER BY D.CountryCode";
		$rows = $db->select($sql);
		// $db->close();

		return $rows;
	}

	function fetchYears() {
		$db = new MySqlDatabase();
		$sql = "SELECT DISTINCT(YearC) as 'YearC' FROM wdi2.databyyear ORDER BY YearC";
		$rows = $db->select($sql);
		// $db->close();

		return $rows;
	}

	function fetchCountries() {
		$db = new MySqlDatabase();
		$sql = "SELECT DISTINCT(CountryName) as 'CountryName', CountryCode FROM wdi2.country ORDER BY CountryName";
		$rows = $db->select($sql);
		// $db->close();

		return $rows;
	}

	function convertCountryNameToCode($countryName) {
		$db = new MySqlDatabase();
		$sql = "SELECT CountryCode FROM wdi2.country WHERE CountryName = '" . $countryName . "' LIMIT 1";
		$rows = $db->select($sql);
		// $db->close();

		return $rows;
	}

	function fetchSeries() {
		$db = new MySqlDatabase();
		$sql = "SELECT DISTINCT(SeriesName) as 'SeriesName', SeriesCode FROM wdi2.series ORDER BY SeriesName";
		$rows = $db->select($sql);
		// $db->close();

		return $rows;
	}

	function convertSeriesNameToCode($seriesName) {
		$db = new MySqlDatabase();
		$sql = "SELECT SeriesCode FROM wdi2.series WHERE SeriesName = '" . $seriesName . "' LIMIT 1";
		$rows = $db->select($sql);
		// $db->close();

		return $rows;
	}

	function populateDataTableFilterRegion($region) {
		$rows = fetchDataFilterRegion($region);

		foreach ($rows as $row) {
			echo "<tr>\n".
					"<td><input type=\"checkbox\" class=\"row-check\" data-id=\"". $row["Id"] ."\" /></td>".
					"<td>". $row["CountryCode"] ."</td>".
					"<td>". $row["SeriesCode"] ."</td>".
					"<td>". explode(" ", $row["YearC"])[0]."</td>".
					"<td>". $row["Data"] ."</td>\n".
				 "</tr>\n";
		}
	}

	function populateRegionList() {
		$rows = fetchRegions();

		foreach ($rows as $row) {
			echo "<li>". $row["Region"]. "</li>\n";
		}
	}

	function populateDataTable() {
		$rows = fetchData();

		foreach ($rows as $row) {
			echo "<tr>\n".
					"<td><input type=\"checkbox\" class=\"row-check\" data-id=\"". $row["Id"] ."\" /></td>".
					"<td>". $row["CountryCode"] ."</td>".
					"<td>". $row["SeriesCode"] ."</td>".
					"<td>". explode(" ", $row["YearC"])[0]."</td>".
					"<td>". $row["Data"] ."</td>\n".
				 "</tr>\n";
		}
	}

	function populateYearDropdown() {
		$rows = fetchYears();

		foreach ($rows as $row) {
			echo "<option value=\"". explode(" ", $row["YearC"])[0] ."\">". explode(" ", $row["YearC"])[0]. "</option>\n";
		}
	}

	function populateCountryDropdown() {
		$rows = fetchCountries();

		foreach ($rows as $row) {
			echo "<option value=\"". $row["CountryCode"] ."\">". $row["CountryName"]. "</option>\n";
		}
	}

	function populateSeriesDropdown() {
		$rows = fetchSeries();

		foreach ($rows as $row) {
			echo "<option value=\"". $row["SeriesCode"] ."\">". $row["SeriesName"]. "</option>\n";
		}
	}

	
?>