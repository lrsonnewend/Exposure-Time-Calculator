<?php
	/**
	 * This class represents the CCD.
	 * @author: Lucas Almeida Salvador
	 */
	
	class CCD
	{
		/**  CCD's Readout Noise*/
		private $readoutNoise;
		/** CCD's gain */
		private $gain;
		/** CCD's quantum Efficiency */
		private $quantumEfficiency;
		/** CCD's serial number*/
		private $ccdNumber;
		/** CCD's binning */
		private $binning;
		/** CCD's pixel size */
		private $pixelSize;


		/**
		* Constructor: It sets up all attributes of CCD.
		*
		* @param int $ccdNumber - number choiced on table ccd. 
		* @param int $mod - It represents the CCD mode choiced
		* @param char $filter - represent the filter choiced.
		* @param int $binning - binning choiced
		*/	
		public function __construct($ccdNumber, $mode ,$filter, $binning)
		{
			$reader = new ReaderJSON();
			$this->setCCDNumber($ccdNumber);
			$this->setQuanTumEfficiency($reader->readQuantumEfficiency($this->getCCDNumber(),$filter));
			$this->setReadoutNoise($reader->readCCDvalues($this->getCCDNumber(),$mode,'readoutNoise'));
			$this->setGain($reader->readCCDvalues($this->getCCDNumber(),$mode,'gain'));
			$this->setBinning($binning);
			$this->setPixelSize($reader->readCCDPixelSize($this->getCCDNumber()));
		}
		/**
		* It sets up the Readout Noise
		* @param float $readoutNoise - CCD's ReadoutNoise
		*/
		public function setReadoutNoise($readoutNoise)
		{
			$this->readoutNoise = $readoutNoise;
		}
		/**
		* It return the readout noise value
		* @return float $redoutNoise - readout noise value
		*/
		public function getReadoutNoise()
		{
			return $this->readoutNoise;
		}
		/**
		* It sets up the Gain
		* @param float $gain - CCD's gain
		*/
		public function setGain($gain)
		{
			$this->gain = $gain;
		}
		/**
		* It return the Gain value
		* @return float $gain - Gain
		*/
		public function getGain()
		{
			return $this->gain;
		}
		/**
		* It sets up the QuantumEfficiency value
		* @param float $quantumEfficiency - quantumEfficiency value
		*/
		public function setQuanTumEfficiency($quantum)
		{
			$this->quantumEfficiency = $quantum;
		}
		/**
		* It returns the quantum efficiency value
		* @return float $quantumEfficiency - quantum Efficiency value
		*/
		public function getQuanTumEfficiency()
		{
			return $this->quantumEfficiency;
		}
		/**
		* It sets up the CCD's serial number 
		* @param int $number - the serial number
		*/
		public function setCCDNumber($number)
		{
			$this->ccdNumber = $number;
		}
		/**
		* It returns the CCD Number
		* @return int $ccdNumber - CCDNumber
		*/
		public function getCCDNumber()
		{
			return $this->ccdNumber;
		}
		/**
		* It Sets up the binning
		* @param int $binning - CCD's binning
		*/
		public function setBinning($binning)
		{
			$this->binning = $binning;
		}
		/**
		* It returns the binning
		* @return int $binning - binning
		*/
		public function getBinning()
		{
			return $this->binning;	
		}

		/**
		* It sets the CCD's pixel size
		* @param float $pixel - CCD's pixel size
		*/
		public function setPixelSize($pixel)
		{
			$this->pixelSize = $pixel;
		}
		/**
		* It returns the CCD's pixel size
		* @return float $pixelSize - CCD's pixel Size
		*/
		public function getPixelSize()
		{
			return $this->pixelSize;
		}
	}
?>
