<?php
	/**
	 * This class represents the Atmospheric conditions at the time of observation
	 * @author: Lucas Almeida Salvador
	 */
	include_once 'ReaderJSON.php';
	class Sky
	{
		/** Number Photons of Sky */
		private $numberPhotons;
		/** Transparency of Sky */
		private $transparencySky;
		/** Magnitude of Sky */
		private $magnitudeSky;
		/** It's a factor to correct possible difference between this ETC results and the real measurements */
		private $fCalib;

		/**
		* Constructor: It sets up attributes of class
		* @param String $transparencySky - Transparency of Sky
		* @param float $airMass - airMass during the observation
		* @param String $filter - Filter selected
		* @param String $moonPhase - moon phase selected
		* @param float $q - Quantum Efficiency
		* @param float $f0 - flux of a zero magnitude source
		* @param float $filterWidth - FilterWidth
		* @param float $effectiveLenght - EffectiveWaveLenght of Filter
		* @param float $dTel - Telescope's Diameter
		* @param float $plateScale - Plate Scale of CCD
		* @param float $fCalib - fCalib
 		* @param float $binning - Binning of CCD.
		*/
		function __construct($transparencySky, $airMass , $filter, $moonPhase , $q , $f0, $filterWidth, $effectiveLenght, $dTel, $plateScale, $fCalib, $binning, $fArea, $tInstr, $tFilter)
		{
			$this->setFcalib($fCalib);
			$reader = new ReaderJSON();
			$this->setTransparencySky($reader->readFilter($filter,$transparencySky), $airMass);
			$this->setMagnitudeSky($reader->readMsky($filter,'sky',$moonPhase));
			$this->setNumberPhotons($this->getMagnitudeSky(), $this->getTransparencySky(), $q, $f0, $filterWidth, $effectiveLenght, $dTel, $plateScale, $binning, $fArea, $tInstr, $tFilter);
		}
		/**
		* It sets up the Number Photons of Sky
		* @param float $mSky - magnitude of Sky
		* @param float $tSky - Transparency of Sky
		* @param float $q - Quantum Efficiency
		* @param float $f0 - flux of a zero magnitude source
		* @param float $filterWidth - FilterWidth
		* @param float $effectiveLenght - EffectiveWaveLenght of Filter
		* @param float $dTel - Telescope's Diameter
		* @param float $plateScale - Plate Scale of CCD
 		* @param float $binning - Binning of CCD.
		*/
		public function setNumberPhotons($mSky, $tSky, $q , $f0, $filterWidth, $effectiveLenght, $dTel, $plateScale, $binning, $fArea, $tInstr, $tFilter)
		{
			if($dTel == 1.60 && $tFilter == 0.65){//telescope reflector diameter 1.60m with U-filter
				$n = $this->getFcalib() *  $q * $tSky * 1.18531e10* $f0 * ($filterWidth/$effectiveLenght) * pow($dTel, 2) * pow($plateScale, 2) * pow($binning, 2) * pow(10, -0.4*$mSky) * $fArea * 0.81 * $tInstr * $tFilter;
				$this->numberPhotons = $n;
			}

			else if($dTel == 0.6 && $tFilter == 0.65){//telescope reflector diameter 0.60m with U-filter
				$n = $this->getFcalib() *  $q * $tSky * 1.18531e10* $f0 * ($filterWidth/$effectiveLenght) * pow($dTel, 2) * pow($plateScale, 2) * pow($binning, 2) * pow(10, -0.4*$mSky) * $fArea * 0.71 * $tInstr * $tFilter;
				$this->numberPhotons = $n;
			}

			else if($dTel == 1.60 && $tFilter == 0.50){//telescope reflector diameter 1.60m with B-filter
				$n = $this->getFcalib() *  $q * $tSky * 1.18531e10* $f0 * ($filterWidth/$effectiveLenght) * pow($dTel, 2) * pow($plateScale, 2) * pow($binning, 2) * pow(10, -0.4*$mSky) * $fArea * 0.81 * $tInstr * $tFilter;
				$this->numberPhotons = $n;
			}

			else if($dTel == 0.6 && $tFilter == 0.50){//telescope reflector diameter 0.60m with B-filter
				$n = $this->getFcalib() *  $q * $tSky * 1.18531e10* $f0 * ($filterWidth/$effectiveLenght) * pow($dTel, 2) * pow($plateScale, 2) * pow($binning, 2) * pow(10, -0.4*$mSky) * $fArea * 0.71 * $tInstr * $tFilter;
				$this->numberPhotons = $n;
			}

			else if($dTel == 1.60 && $tFilter == 0.75){//telescope reflector diameter 1.60m with V-filter
				$n = $this->getFcalib() *  $q * $tSky * 1.18531e10* $f0 * ($filterWidth/$effectiveLenght) * pow($dTel, 2) * pow($plateScale, 2) * pow($binning, 2) * pow(10, -0.4*$mSky) * $fArea * 0.80 * $tInstr * $tFilter;
				$this->numberPhotons = $n;
			}

			else if($dTel == 0.60 && $tFilter == 0.75){//telescope reflector diameter 0.60m with V-filter
				$n = $this->getFcalib() *  $q * $tSky * 1.18531e10* $f0 * ($filterWidth/$effectiveLenght) * pow($dTel, 2) * pow($plateScale, 2) * pow($binning, 2) * pow(10, -0.4*$mSky) * $fArea * 0.78 * $tInstr * $tFilter;
				$this->numberPhotons = $n;
			}

			else if($dTel == 1.60 && $tFilter == 0.70){//telescope reflector diameter 1.60m with R-filter
				$n = $this->getFcalib() *  $q * $tSky * 1.18531e10* $f0 * ($filterWidth/$effectiveLenght) * pow($dTel, 2) * pow($plateScale, 2) * pow($binning, 2) * pow(10, -0.4*$mSky) * $fArea * 0.78 * $tInstr * $tFilter;
				$this->numberPhotons = $n;
			}

			else if($dTel == 0.60 && $tFilter == 0.70){//telescope reflector diameter 0.60m with R-filter
				$n = $this->getFcalib() *  $q * $tSky * 1.18531e10* $f0 * ($filterWidth/$effectiveLenght) * pow($dTel, 2) * pow($plateScale, 2) * pow($binning, 2) * pow(10, -0.4*$mSky) * $fArea * 0.75 * $tInstr * $tFilter;
				$this->numberPhotons = $n;
			}

			else if($dTel == 1.60 && $tFilter == 0.82){//telescope reflector diameter 1.60m with I-filter
				$n = $this->getFcalib() *  $q * $tSky * 1.18531e10* $f0 * ($filterWidth/$effectiveLenght) * pow($dTel, 2) * pow($plateScale, 2) * pow($binning, 2) * pow(10, -0.4*$mSky) * $fArea * 0.67 * $tInstr * $tFilter;
				$this->numberPhotons = $n;
			}

			else if($dTel == 0.60 && $tFilter == 0.50){//telescope reflector diameter 0.60m with I-filter
				$n = $this->getFcalib() *  $q * $tSky * 1.18531e10* $f0 * ($filterWidth/$effectiveLenght) * pow($dTel, 2) * pow($plateScale, 2) * pow($binning, 2) * pow(10, -0.4*$mSky) * $fArea * 0.65 * $tInstr * $tFilter;
				$this->numberPhotons = $n;
			}
		}
		/**
		* It returns the numberPhotons 
		* @return float $numberPhotons - number photons of Sky
		*/
		public function getNumberPhotons()
		{
			return $this->numberPhotons;
		}
		/**
		* It sets up the Transparency of Sky 
		* @param float $k - coefficient of extinction
		* @param float $x - air mass
		*/
		public function setTransparencySky($k , $x)
		{
			$this->transparencySky = pow(10,-0.4*$k*$x);
		}
		/**
		* It returns the Transparency of Sky
		* @return float $transparencySky - transparency of sky
		*/
		public function getTransparencySky()
		{
			return $this->transparencySky;
		}
		/**
		* It sets up the Magnitude of Sky
		* @param float $magnitude - magnitude of sky
		*/
		public function setMagnitudeSky($magnitude)
		{
			$this->magnitudeSky = $magnitude;
		}
		/**
		* It returns the Magnitude of Sky
		* @return float $magnitude - magnitude of sky
		*/
		public function getMagnitudeSky()
		{
			return $this->magnitudeSky;
		}
		/**
		* It's set up the FCablib
		* @param $value - Fcalib
		*/
		public function setFcalib($value)
	 	{
	 		$this->fCalib = $value;
	 	}
	 	/**
		* It returns the Fcalib
		* @return float $fCalib - fCalib
		*/
	 	public function getFcalib()
	 	{
	 		return $this->fCalib;
	 	}
	}
?>
