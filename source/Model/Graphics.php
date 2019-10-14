<?php
	/**
	 * This class generate the data set to build the graph 
	 * @author: Lucas Almeida Salvador
	 */
	class Graphics 
	{
		/** Observation object */
		private $observation;
		/** Sky object */
		private $sky;
		/** Instrument object*/
		private $instrument;


		/**
		* Constructor: It Sets up Graphics attributes
		* @param $observationObject - Observation object
		* @param $skyObject - Sky object
		* @param $instrument - Instrument object 
		*/
		function __construct($observationObject,$skyObject, $instrumentObject)
		{
			$this->setObservation($observationObject);
			$this->setSky($skyObject);
			$this->setInstrument($instrumentObject);
		}
		/**
		* It Sets up the Observation 
		* @param Observation $observationObject
		*/
		public function setObservation(Observation $observationObject)
		{
			$this->observation = $observationObject;
		}
		/**
		* It Returns the Observation object
		* @return $observation - Observation object
		*/
		public function getObservation()
		{	
			return $this->observation;
		}
		/**
		* It Sets up the Sky object
		* @param Sky $skyObject - Sky object
		*/
		public function setSky(Sky $skyObject)
		{	
			$this->sky = $skyObject;
		}
		/**
		* It Returns the sky object
		* @return $sky - Sky object
		*/
		public function getSky()
		{	
			return $this->sky;
		}
		/**
		* It Sets up the Instrument object
		* @param Instrument $instrumentObject - object
		*/
		public function setInstrument(Instrument $instrumentObject)
		{
			$this->instrument = $instrumentObject;
		}
		/**
		*It returns Instrument object 
		* @return Instrument $instrument - Instrument object
		*/
		public function getInstrument()
		{	
			return $this->instrument;
		}
		/**
		* Generate a dataset to build the graph. 
		* If $timeIntegration > 500 the values are generate from 1 to 500 else the values are to $timeIntegration
		* @param float $timeIntegration - Integration Time 
		* @param int $nwp - Number of WavePlates Positions 
		* @param float $wave - Waveplate 
		* @return Array $data - dataset to build the graph
		*/
		public function generateValues($timeIntegration , $nwp, $wave)
		{			
			$timeRange = $timeIntegration;
			
			$data = array();
			// It's defining the values at $time = 1s
			
			// In wavelate of 1/2 wave
			if($wave=='1/2')
	 		{	
	 			$this->getObservation()->setSignalNoiseRatio(1,$this->getObservation()->getNumberPhotons(), 1, $this->getObservation()->getNumberPixels(), $this->getSky()->getNumberPhotons(),$this->getInstrument()->getCCD()->getReadoutNoise(),$this->getInstrument()->getCCD()->getGain(), $this->getInstrument()->getCCD()->getBinning());

				$this->getObservation()->setSigmaP(1,$this->getObservation()->getSignalNoiseRatio(),$nwp);
	 		}
			// In wavelate of 1/4 wave
	 		elseif ($wave=='1/4')
	 		{	
	 			$this->getObservation()->setSignalNoiseRatio(1,$this->getObservation()->getNumberPhotons(), 1, $this->getObservation()->getNumberPixels(), $this->getSky()->getNumberPhotons(),$this->getInstrument()->getCCD()->getReadoutNoise(),$this->getInstrument()->getCCD()->getGain(),  $this->getInstrument()->getCCD()->getBinning());

				$this->getObservation()->setSigmaP(2,$this->getObservation()->getSignalNoiseRatio(),$nwp);
	 		}
			//It's Setting the values to 1s
			#$data[] = array('',1, round($this->getObservation()->getSigmaP(),3) );
			
			//It's Defining the values time ​​starting with their minimum value up to the maximum value in an interval of 5 seconds
			$minTime = $timeRange/10;
			$maxTime = $timeRange*2;
			$average = $minTime*0.35;
			
			for ($time = $minTime; $time <= $maxTime; $time+=$average)
			{ 	 
				if($wave=='1/2')
		 		{
		 			$this->getObservation()->setSignalNoiseRatio(1,$this->getObservation()->getNumberPhotons(), $time, $this->getObservation()->getNumberPixels(), $this->getSky()->getNumberPhotons(),$this->getInstrument()->getCCD()->getReadoutNoise(),$this->getInstrument()->getCCD()->getGain(),  $this->getInstrument()->getCCD()->getBinning());

					$this->getObservation()->setSigmaP(1,$this->getObservation()->getSignalNoiseRatio(),$nwp);
		 		}
				// In wavelate of 1/4 wave
		 		elseif ($wave=='1/4')
		 		{	
		 			$this->getObservation()->setSignalNoiseRatio(1,$this->getObservation()->getNumberPhotons(), $time, $this->getObservation()->getNumberPixels(), $this->getSky()->getNumberPhotons(),$this->getInstrument()->getCCD()->getReadoutNoise(),$this->getInstrument()->getCCD()->getGain(),  $this->getInstrument()->getCCD()->getBinning());

					$this->getObservation()->setSigmaP(2,$this->getObservation()->getSignalNoiseRatio(),$nwp);
		 		}
				//It's Saving the values in Array
				$data[] = array('', $time, $this->getObservation()->getSigmaP());
			}

			//It's retorning the Array
			return $data;
		}



		public function generateValuesCD($timeIntegration, $nwp)
		{
			$timeRange = $timeIntegration;
			
			$data = array();
			// It's defining the values at $time = 1s
			
			
	 		$this->getObservation()->setSignalNoiseRatioCD(1,$this->getObservation()->getNumberPhotons(), 1, $this->getObservation()->getNumberPixels(), $this->getSky()->getNumberPhotons(),$this->getInstrument()->getCCD()->getReadoutNoise(),$this->getInstrument()->getCCD()->getGain(), $this->getInstrument()->getCCD()->getBinning());

			$this->getObservation()->setSigmaM(1,$this->getObservation()->getSignalNoiseRatioCD(),$nwp);


				
			//It's Setting the values to 1s

			
			//It's Defining the values time ​​starting with their minimum value up to the maximum value in an interval of 5 seconds
			//if ($timeIntegration >= 1.0){
			$minTime = $timeRange/10;
			$average = $minTime*0.35;
			$maxTime = $timeRange*2;
			#$data[] = array('',1, round($this->getObservation()->getSigmaM(),3));

			for ($time = $minTime; $time <= $maxTime; $time+= $average)
				{ 	
					/*$c+=1;
					if ($c > 3)
						$average = 0.6;*/
				 	$this->getObservation()->setSignalNoiseRatioCD(1,$this->getObservation()->getNumberPhotons(), $time, $this->getObservation()->getNumberPixels(), $this->getSky()->getNumberPhotons(),$this->getInstrument()->getCCD()->getReadoutNoise(),$this->getInstrument()->getCCD()->getGain(),  $this->getInstrument()->getCCD()->getBinning());

					$this->getObservation()->setSigmaM(1,$this->getObservation()->getSignalNoiseRatioCD(),$nwp);
					
					//It's Saving the values in Array

					$data[] = array('',$time, $this->getObservation()->getSigmaM());
				}


				//It's retorning the Array
				return 	$data;
		
			}
		}
?>
