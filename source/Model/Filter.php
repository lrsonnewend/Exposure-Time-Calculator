<?php
 /**
  * This class represents the Filter used during the observation
  * @author: Lucas Almeida Salvador
  */
 include 'ReaderJSON.php';
 class Filter 
 {
 	/** Filter Width*/
 	private $filterWidth;
 	/** Effective wavelength*/
 	private $effectiveLenght;
 	/** Flux Magnitude Zero*/
 	private $fluxZero;

 	/**
 	* Constructor: It Sets up the Filter attributes
 	* @param $filter - Filter choiced by the User
 	*/
 	function __construct($filter)
 	{
 		$reader = new ReaderJSON();
 		$this->setFilterWidth($reader->readFilter($filter, 'filterWidth'));
 		$this->setEffectiveLenght($reader->readFilter($filter,'effectiveLenght'));
 		$this->setFluxZero($reader->readFilter($filter,'fluxZero'));
 		$this->setTFilter($reader->readFilter($filter, 'tFilter'));
 	}
 	/**
 	* It Sets up the Filter Width
 	* @param float $filter - Filter width 
 	*/
 	public function setFilterWidth($filter)
 	{
 		$this->filterWidth = $filter;
 	}
 	/**
 	* It Returns the Filter Width
 	* @return float $filterWidth - Filter Width
 	*/
 	public function getFilterWidth()
 	{
 		return $this->filterWidth;
 	}
 	/**
 	* It Sets up the Transmitance Filter
 	* @param float $transmitance - Transmitance Filter
 	*/
 	public function setTFilter($transmitance){
 		$this->tFilter = $transmitance;
 	}
 	/**
 	* It Returns the Transmitance Filter
 	* @return float  $tFilter - Transmitance Filter
 	*/
 	public function getTFilter(){
 		return $tFilter;
 	}
 	/**
 	* It Sets up the Effective Wavelenght
 	* @param float $effective - Effective wavelenght
 	*/
 	public function setEffectiveLenght($effective)
 	{
 		$this->effectiveLenght = $effective;
 	}
 	/**
 	* It returns the Effective Wavelenght
 	* @return float $effectiveLenght - Effecitive wavelenght
 	*/
 	public function getEffectiveLenght()
 	{
 		return $this->effectiveLenght;
 	}
 	/**
 	* It Sets up the Flux Magnitude Zero
 	* @param float $flux - Flux Magnitude Zero
 	*/
 	public function setFluxZero($flux)
 	{
 		$this->fluxZero = $flux;
 	}
 	/**
 	* It returns the Flux Magnitude Zero
 	* @return float $fluxZero - flux Magnitude Zero
 	*/
 	public function getFluxZero()
 	{
 		return $this->fluxZero;
 	}
 }
?>
