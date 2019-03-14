<?php
	/**
	 * This class reads the JSON file and returns the requires values
	 * @author: Lucas Almeida Salvador
	 */
	class ReaderJSON
	{
		/**
		* It Reads the Quantum Efficiency value
		* @param Int $ccdNumber - CCD's serial number
		* @param String $FilterColor - Filter selected
		*/
		function readQuantumEfficiency($ccdNumber, $filterColor)
		{
			$arquivo = file_get_contents(__DIR__.'/../../static/CCD'.$ccdNumber.'.json');
			$json = json_decode($arquivo);
			return $json->QuantumEfficiency->$filterColor;
		}
		/**
		* It reads the CCD values as gain, readout Noise etc.
		* @param Int $ccdNumber - CCD's serial number
		* @param int $ccdMode - Operation Mode of CCD
		* @param String $attribute - attribute required
		*/
		function readCCDvalues($ccdNumber,$ccdMode, $attribute)
		{
			$arquivo = file_get_contents(__DIR__.'/../../static/CCD'.$ccdNumber.'.json');
			$json = json_decode($arquivo);
			return $json->Modes->$ccdMode->$attribute;
		}
		/**
		* It reads the CCD pixel Size
		* @param Int $ccdNumber - CCD's serial number
		*/
		function readCCDPixelSize($ccdNumber)
		{
			$arquivo = file_get_contents(__DIR__.'/../../static/CCD'.$ccdNumber.'.json');
			$json = json_decode($arquivo);
			return $json->PixelSize;
		}
		/**
		* It reads the Filter values as effective wavelength, flux zero etc
		* @param String $filter - filter selected
		* @param String $attribute - attribute selected
		*/
		function readFilter($filter, $attribute)
		{
			$arquivo = file_get_contents(__DIR__.'/../../static/filter.json');
			$json = json_decode($arquivo);
			return  $json->$filter->$attribute;
		}
		/**
		* It reads the Magnitude Sky values
		* @param String $filter - filter selected
		* @param String $attribute - attribute selected
		* @param String $phase - moon phase selected
		*/
		function readMsky($filter, $attribute, $phase)
		{
			$arquivo = file_get_contents(__DIR__.'/../../static/filter.json');
			$json = json_decode($arquivo);
			return $json->$filter->$attribute->$phase;
		}
	}
?>
