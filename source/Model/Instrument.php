<?php
 /**
  * This class represents the Instrument used during the observation and its main attributes
  * @author: Lucas Almeida Salvador
  */
	
 class Instrument 
 {
 	/** Number of Wave Plates Positions to the Instrument*/
 	private $numberWavePlates;
 	/** Telescope's Diameter of aperture*/
 	private $aperture;
 	/** Focal Reducer */
 	private $focalReducer;
 	/** Plate Scale on CCD */
 	private $plateScaleCCD;
 	/** CCD */
 	private $ccd;
 	/** Plata Scale in telescope*/
 	private $plateScaleTelescope;
 	/** The fraction of the telescope area that effectively collects photons*/
 	private $fArea;
 	/** The transmission of the telescope surface*/
 	private $tTel;
 	/** the transmission in the instrument*/
 	private $tInstr;
 	/**The transmission of the filter.*/
 	private $tFilter;
 	/**
 	* Constructor: It sets up the Instrument attributes
 	* 
 	* @param int $numberWavePlates - number of Wave Plates Positions 
 	* @param float $dTel - Telescope's Diameter of aperture
 	* @param int $focal - Focal reducer
 	* @param CCD $ccd - CCD
 	*/
 	function __construct($numberWavePlates, $dTel, $focalReducer,$ccd)
 	{
 		$this->setNumberWavePlates($numberWavePlates);
 		$this->setAperture($dTel);
 		$this->setFocalReducer($focal);
 		$this->setCCD($ccd);
 		$this->setPlateScaleTelescope($dTel);
 		$this->setPlateScale($focalReducer);
 	}
 	/**
 	* It sets up the Number of WavePlate Positions
 	* @param int $number - Number of WavePlate Positions
 	*/
 	public function setNumberWavePlates($number)
 	{
 		$this->numberWavePlates = $number;
 	}
 	/**
 	* It returns the number of waveplate positions
 	* @return int $numberWavePlates - Number of WavePlate Positions
 	*/
 	public function getNumberWavePlates()
 	{
 		return $this->numberWavePlates;
 	}
 	/**
 	* It sets up the Telescope's Diameter of aperture
 	* @param float $aperture - Telescope's aperture diameter
 	*/
 	public function setAperture($aperture)
 	{
 		$this->aperture = $aperture;
 	}
 	/**
 	* It returns the Telescope's Diameter of aperture
 	* @return float $aperture - Telescope's Diameter of aperture
 	*/
 	public function getAperture()
 	{
 		 return $this->aperture;	
 	}
 	/**
 	* It sets up the Focal Reducer
 	* @param boolean $focalReducer - Focal Reducer 
 	*/
 	public function setFocalReducer($focalReducer)
 	{
 		$this->focalReducer = $focalReducer;
 	}
 	/**
 	* It return the Focal Reducer
 	* @return boolean $focalReducer - Focal reducer
 	*/
 	public function getFocalReducer()
 	{
 		return $this->focalReducer;
 	}
 	/**
 	* It sets up the Plate Scale
 	* @param boolean $focalReducer - focal reducer on Instrument
 	*/
 	public function setPlateScale($focalReducer)
 	{	//Defining the factor 
 		if($focalReducer == 1)
 		{
 			$factor = 2;
 		}
 		else
 		{
 			$factor = 1;
 		}
 		$this->plateScaleCCD = $this->getPlateScaleTelescope() * $this->getCCD()->getPixelSize() * $factor;
 	}
 	/**
 	* It returns the PlateScale   
 	* @return float $plateScale - PlateScale
 	*/
 	public function getPlateScale()
 	{
 		return $this->plateScaleCCD;
 	}
 	/**
 	* It sets up the CCD
 	* @param CCD $ccd - CDD used in the observation
 	*/
 	public function setCCD(CCD $ccd)
 	{
 		$this->ccd = $ccd;
 	}
 	/** 
 	* It returns the CCD
	* @return CCD $ccd - CCD used in the observation
 	*/
 	public function getCCD()
 	{
 		return $this->ccd;
 	}
 	/**
 	* It sets up the Plate Scale Telescope
 	* @param float $dTel - telescope Diameter
 	*/
 	public function setPlateScaleTelescope($dTel)
 	{	
 		/**Defining the plate scale according to the diameter of the telescope
 		* This values taken from http://lnapadrao.lna.br/OPD/telescopios/telescopios-do-opd
 		*/
 		if($dTel == 1.6)
 		{
 			$this->plateScaleTelescope = 13.09;
 		}
 		else
 		{
 			$this->plateScaleTelescope = 29.09;	
 		}
 	}
 	/**
 	* It returns the plate scale telescope
	* @return float $plateScaleTelescope - Telescope's Plate Scale
 	*/
 	public function getPlateScaleTelescope()
 	{
 		return $this->plateScaleTelescope;
 	}
 	/**
 	* It sets up the fArea of telescope
 	* @param float $area - The fraction of the telescope area that effectively collects photons 
 	*/
 	public function setFArea($area)
 	{
 		$this->fArea = $area;
 	}
 	/**
 	* It returns the fArea 
	* @return float $fArea - The fraction of the telescope area that effectively collects photons 
 	*/
 	public function getFArea()
 	{
 		return $this->fArea;
 	}
 	/**
 	* It sets up the tTel, The transmission of the telescope surface
 	* @param char $filter - represents the chosen filter
 	*/
 	public function setTTel($filter)
 	{
 		$reader = new ReaderJSON();
 		$tTel = $reader->readFilter($filter, 'tTel');
 		$this->tTel = $tTel;
 	}
 	/**
 	* It returns tTel
	* @return float $tTel - The transmission of the telescope surface
 	*/
 	public function getTTel()
 	{
 		return $this->tTel;
 	}
 	/**
 	* It sets up the tInstr, the transmission in the instrument
 	* @param boolean $focal reducer - represents the value of focalReducer
 	*/
 	public function setTInstr($focal)
 	{
 		if($focal)
 			$this->tInstr = 0.90;
 		else
 			$this->tInstr = 0.95;
 	}
 	/**
 	* It returns the tInstr the transmission in the instrument
	* @return float $TInstr - the transmission in the instrument
 	*/
 	public function getTInstr()
 	{
 		return $this->tInstr;
 	}
 	/**
 	*It sets up the tFilter, The transmission of the filter
	* @param char $filter - represents the chosen filter
 	*/
 	public function setTFilter($filter)
 	{
 		$reader = new ReaderJSON();
 		$tFilter = $reader->readFilter($filter, 'tFilter');
 		$this->tFilter = $tFilter;
 	}
	/* 
	* It returns the tFilter, The transmission of the filter
	* @return float $tFilter, The transmission of the filter 
	*/
 	public function getTFilter()
 	{
 		return $this->tFilter;
 	}
 }
?>