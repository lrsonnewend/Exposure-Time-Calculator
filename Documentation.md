# Documentation of ETC 

## Project description
The Exposure Time Calculator (ETC) is a tool to calculate the integration time or some observational error of an observation. The ETC consists of three ETCs: 
 * ETC - IAGPOL of the IAGPOL instrument. 
 * ETC - SPARC4, the SPARC4 instrument. 
 * ETC - Camara Direta of the Camara Direta instrument. 
 
The ETC was created in PHP 7.1 using the MVC architecture. In addition to these technologies, JSON, HTML5, CSS3 and JavaScript were used.

This documentation is simple and objective to give an overview, so will not go into details of the operation of ETC. For further details refer to the ETC [code](https://github.com/LASalvador/Exposure-Time-Calculator/tree/master/source).

## Folder structure
This topic is intended to describe folders in the project.
Based on the project root folder, the description of each ETC project folder is described below.
### [/css](https://github.com/LASalvador/Exposure-Time-Calculator/tree/master/css)
It Contains all css files on the page. The files in this folder follow the following pattern:

**css-{nomeDaPagina/Elemento}.css.**
### [/fonts ](https://github.com/LASalvador/Exposure-Time-Calculator/tree/master/fonts)
It Contains all fonts used on pages.
### [/img ](https://github.com/LASalvador/Exposure-Time-Calculator/tree/master/img)
It Contains all images used on pages.
### [/include](https://github.com/LASalvador/Exposure-Time-Calculator/tree/master/include)
It Contains a PHP file, called functions.php, responsible for loading the page trace.
### [/js](https://github.com/LASalvador/Exposure-Time-Calculator/tree/master/js)
It Contains all JavaScript files used on pages.
### [/source ](https://github.com/LASalvador/Exposure-Time-Calculator/tree/master/source)
It contains all the codes responsible for the calculations that the ETC performs.
### [/source/Controller ](https://github.com/LASalvador/Exposure-Time-Calculator/blob/master/source/Controller).)
It Contains the files responsible for managing user interactions having a method for each possible user action
### [/source/Model](https://github.com/LASalvador/Exposure-Time-Calculator/blob/master/source/Model).)
It Contains the files related to the models, that is, the classes responsible for generating the objects used in the project.
### [/static](https://github.com/LASalvador/Exposure-Time-Calculator/tree/master/static)
It contains all the static files of the application. Static files are files that are sent to the browser exactly as they are on the server's hard drive. Note that the **.css** and **.js** files are part of this type of files, however it was preferred to leave them external to this folder.
### [/vendor ](https://github.com/LASalvador/Exposure-Time-Calculator/tree/master/vendor)
Folder created by the composer responsible for managing the autoloads and dependencies of files in the code.
### [/view ](https://github.com/LASalvador/Exposure-Time-Calculator/tree/master/views)
Folder containing all pages of the site, that is, all the files with **.html** are responsible for generating the body of the page.

## Important Files
This topic is intended to report the files essential to the operation of the project and in some of those files its methods will be detailed.

### [/source/Router.php](https://github.com/LASalvador/Exposure-Time-Calculator/blob/master/source/Router.php)
This file is responsible for managing the existing routes in the site. In addition, it is also able to determine the HTTP request method
### [/source/Model/CCD.php](https://github.com/LASalvador/Exposure-Time-Calculator/blob/master/source/Model/CCD.php)
This class represents the [CCD](https://en.wikipedia.org/wiki/Charge-coupled_device) used in the instrument. Below is a description of its methods and attributes for more details see the [class](https://github.com/LASalvador/Exposure-Time-Calculator/blob/master/source/Model/CCD.php).
#### Attributes
**Readout noise** - It represents the readout noise to the CCD.

**Gain** - It represents the CCD's gain

**Quantum Efficiency** - It represents the CCD's quantum efficiency

**CCD number** - It is the serial number of the CCD.
 
**Binning**  - It represents the CCD's binning.

**Pixel Size** - It represents the pixel size in CCD. 
#### Methods
##### construct()
This method builds the object and sets all attributes.
##### setReadoutNoise()
It Sets up Readout Noise 
##### getReadoutNoise()
It returns the Readout noise
##### setGain()
It sets up the Gain.
##### get Gain()
It returns the Gain.
##### setQuantumEfficiency()
It sets up the Quantum Efficiency.
##### getQuantumEfficiency()
It returns the Quantum Efficiency. 
##### setCCDNumber()
It sets up the CCD number
##### getCCDNumber()
It returns the CCD number
##### setBinning()
It sets up the Binning
##### getBinning()
It returns the Binning. 
##### setPixelSize()
It sets up the pixel size
##### getPixelSize()
It returns the pixel size

### [/source/Model/Filter.php](https://github.com/LASalvador/Exposure-Time-Calculator/blob/master/source/Model/Filter.php)
This class represents the Filter used during the Observation. Below is a description of its methods and attributes for more details see the [class](https://github.com/LASalvador/Exposure-Time-Calculator/blob/master/source/Model/Filter.php).
#### Attributes
**Filter width** - It represents the Filter's width. 

**Effective length** -It represents the Filter's effective wavelength.

**Flux zero** - It represents the flux of magnitude zero.
#### Methods
##### constructor()
It builds the object and defines all attributes. 
##### setfilterWidth()
It sets up the filter width
##### getFilterWidth()
It returns the filter width
##### setEffectiveLength()
It sets up the Effective wavelength
##### getEffectiveLength()
It returns the Effective wavelength 
##### setFluxZero()
It sets up the Flux magnitude zero
##### getFluxZero()
It returns the Flux magnitude zero.

### [/source/Model/Graphics.php](https://github.com/LASalvador/Exposure-Time-Calculator/blob/master/source/Model/Graphics.php)
It Responsible for generating the data set for the chart. Below is a description of its methods and attributes for more details see the[class](https://github.com/LASalvador/Exposure-Time-Calculator/blob/master/source/Model/Graphics.php).
#### Attributes
**Observation** - represents an Observation Object

**Sky** - represents a Sky Object

**Instrument** - represents an Instrument Object
#### Methods
##### setObservation()
It sets up the Observation Object
##### getObservation()
It returns the Observation Object
##### setSky()
It sets up the Sky Object
##### getSky()
It returns the Sky Object
##### setInstrument()
It sets up the Instrument Object
##### getInstrument()
It returns the Instrument Object
#### generateValues()
It generates a dataset to construct the graph.

### [/source/Model/Instrument.php](https://github.com/LASalvador/Exposure-Time-Calculator/blob/master/source/Model/Instrument.php)
This class represents the instrument and its attributes. Below is a description of its methods and attributes for more details see the[class](https://github.com/LASalvador/Exposure-Time-Calculator/blob/master/source/Model/Instrument.php).

#### Attributes
**Number waveplates** - It represents the number of waveplate positions.

**Aperture** - It represents Telescope's Diameter of aperture.

**Focal reducer** - It represents focal reducer. 

**Plate Scale**  - It represents the plate scale of the instrument.

**CCD** - It represents the CCD.

**Plate Scale Telescope** - It represents the Instrument of telescope

**fArea** - It represents the fraction of the telescope area that effectively collects photons

**tTel** -  It represents the transmission of the telescope surface

**tInstr** - It represents the transmission in the instrument

**tFilter** - It represents the transmission of the filter


#### Methods
##### constructor()
It builds the object and sets up all attributes.
##### setNumberWavePlates()
It sets up the number of wave plates 
##### getNumberWavePlates()
It returns the number of waveplates
##### setAperture()
It sets up the Telescope Diameter
##### getAperture()
It returns the Telescope Diameter
##### setFocalReducer()
It sets up the focal reducer
##### getFocalReducer()
It returns the Focal Reducer
##### setPlateScale()
It sets up Plate Scale
##### getPlateScale()
It returns  Plate Scale
##### setCCD()
It sets up CCD
##### getCCD()
It returns CCD
##### setPlateScaleTelescope ()
It Sets the Plate Scale Telescope
##### getPlateScaleTelescope ()
It Returns the Plata Scale Telescope 
##### setFArea()
It Sets the FArea
##### getFArea()
It retuns the FArea
##### setTTel()
It Sets the tTel
##### getTTel()
It returns the tTel
##### setTInstr()
It Sets the tInstr
##### getTInstr()
It returns the tInstr 
##### setTFilter()
It sets up the tFilter
##### getTFilter()
It returns the tFilter


### [/source/Model/Observation.php](https://github.com/LASalvador/Exposure-Time-Calculator/blob/master/source/Model/Observation.php)
This class represents the Observation and its attributes. Below is a description of its methods and attributes for more details see the[class](https://github.com/LASalvador/Exposure-Time-Calculator/blob/master/source/Model/Observation.php).
#### Attributes 
**SigmaP** - Error of the linear polarization 

**SigmaV** - error of the circular polarization 

**Number photons** - the number of source photons.

**Magnitude** - the magnitude of the source
**Signal Noise Ratio** - It represents the signal to noise ratio of the source. 

**Number pixels** - It represents the number of source pixels. 

**Radius aperture** - It represents the aperture radius to photometry 

**Time Exposure** - Integration time to source 

**fCalib** - It's a factor to correct the possible difference between this ETC results and the real measurements 

#### Methods 
##### constructor()
It builds the object and sets up the attributes: fcalib, Magnitude, Radius Aperture, number pixels, Number Photons.  
##### setSigmaP() 
It sets up the sigmaP
##### getSigmaP()
It returns the sigmaP
##### setSigmaV()
It sets up the SigmaV
##### getSigmaV()
It returns the SigmaV
##### setNumberPhotons()
It sets up number Of source photons
##### getNumberPhotons()
It returns number of source photons
##### setMagnitude()
It sets up the Magnitude
##### getMagnitude()
It returns the magnitude 
##### setSignalNoiseRatio()
It sets up the Signal to noise ratio
##### getSignalNoiseRatio()
It returns the Signal to noise ratio 
##### setNumberpixels()
It sets up the number of pixels
##### getNumberpixels()
It returns the number of pixels
##### setRadiusAperture()
It sets up the aperture radius
##### getRadiusAperture()
It returns the aperture radius
##### setTimeExposure()
It sets up the integration time
##### getTimeExposure()
It returns the integration time 
##### setFcalib()
It sets up Fcalib
##### getFcalib()
It returns Fcalib

### [/source/Model/ReaderJSON.php](https://github.com/LASalvador/Exposure-Time-Calculator/blob/master/source/Model/ReaderJSON.php)
It’s responsible to read the [JSON](https://www.json.org/) files.
#### Methods
##### readQuantumEfficiency()
It reads the the quantum efficiency value.
##### readCCDValues()
It reads the readout noise and gain of CCD.
##### readCCDPixelSize()
It reads the CCD’s pixel size
##### readFilter()
It reads the filter atrributes
##### readMsky()
It reads the Magnitude of Sky

### [/source/Model/Sky.php](https://github.com/LASalvador/Exposure-Time-Calculator/blob/master/source/Model/Sky.php)
Represent the Atmospheric conditions at the time of observation.  Below is a description of its methods and attributes for more details see the[class](https://github.com/LASalvador/Exposure-Time-Calculator/blob/master/source/Model/Sky.php).

#### Attributes
**NumberPhotons** - It represents the number Photons of sky.

**Transparency sky** - It represents the transparency of the sky.

**Magnitude sky** - It represents the magnitude of the sky.

**fCalib** - It's a factor to correct the possible difference between this ETC results and the real measurements.

#### Methods
##### constructor()
It builds the object and set all the attributes
##### setNumberPhotons()
It sets up the number of photons of sky 
##### getNumberPhotons()
It returns the number of photons. 
##### setTransparencySky() 
It sets up the transparency of the sky. 
##### getTransparencySky()
It returns the transparency of the sky. 
##### setMagnitudeSky()
It sets up the Magnitude of sky
##### getMagnitudeSky()
It returns the Magnitude of Sky.

### [/source/Controller/Controller.php](https://github.com/LASalvador/Exposure-Time-Calculator/blob/master/source/Controller/Controller.php)
Abstract class bringing essential methods to a controller. Among them we can mention: loading pages, capturing parameters sent by HTTP, redirecting pages and saving values in SESSION.

### [source/Controller/APPController.php](https://github.com/LASalvador/Exposure-Time-Calculator/blob/master/source/Controller/APPController.php)
Class responsible for controlling the application according to the user's request.

#### Methods
##### index()
It loads the homepage.
##### about()
It loads the about page.
##### loadForm()
It loads the ETC form in use.
##### loadOutput()
It loads the ETC output page in use.
##### loadInformation()
It loads the ETC information page in use.
##### submitFormIAGPOL()
It is responsible for generating the ETC-IAGPOL responses. 
##### submitFormCD()
It is responsible for generating the ETC-CD responses. 
##### submitFormSPARC4()
It is responsible for generating the ETC-SPARC4 responses. 

### /view/about.php
It's responsible for the screen with information on the development of ETC

### /view/barra-governo.php
It's responsible for the government bar at the top of the page.

### /view/formCD.php
ETC - Camara Direta page

### /view/formIAGPOL.php
ETC - IAGPOL page

### /view/formSPARC4.php
ETC - SPARC4 page

### /view/home.php
The site's HomePage

### /view/informationCD.php
"Information" page for the ETC - CD

### /view/informationIAGPOL.php
"Information" page for the ETC - IAGPOL

### /view/informationSPARC4.php
"Information" page for the ETC - SPARC4

### /view/menu.php
It's responsible for the side menu of all pages

### /view/outputCD.php
Page with exits of ETC - CD

### /view/outputIAGPOL.php
Page with exits of ETC - IAGPOL

### /view/outputSPARC4.php
Page with exits of ETC - SPARC4

### /view/rodape.php
Page footer

### /view/rodape-governo.php
Government footer

### /view/tabelasCCDIAGPOL.php
It contains the tables of the CCDs used in the ETC - IAGPOL

### /view/topo.php
Page Header

### /static/CCD10127.json
It contains information regarding the CCD with serial number 10127. As: operating modes, pixel size and quantum efficiency
### /static/CCD105.json
It contains information regarding the CCD with serial number 105. As: operating modes, pixel size and quantum efficiency
### /static/CCD106.json
It contains information regarding the CCD with serial number 106. As: operating modes, pixel size and quantum efficiency
### /static/CCD13739.json
It contains information regarding the CCD with serial number 13739. As: operating modes, pixel size and quantum efficiency
### /static/CCD13740.json
It contains information regarding the CCD with serial number 13749. As: operating modes, pixel size and quantum efficiency
### /static/CCD14912.json
It contains information regarding the CCD with serial number 14912. As: operating modes, pixel size and quantum efficiency
### /static/CCD17587.json
It contains information regarding the CCD with serial number 17587. As: operating modes, pixel size and quantum efficiency
### /static/CCD17588.json
It contains information regarding the CCD with serial number 17588. As: operating modes, pixel size and quantum efficiency
### /static/CCD19002.json
It contains information regarding the CCD with serial number 19002. As: operating modes, pixel size and quantum efficiency
### /static/CCD4269.json
It contains information regarding the CCD with serial number 4269. As: operating modes, pixel size and quantum efficiency
### /static/CCD4335.json
It contains information regarding the CCD with serial number 4335. As: operating modes, pixel size and quantum efficiency
### /static/CCD9867.json
It contains information regarding the CCD with serial number 9867. As: operating modes, pixel size and quantum efficiency

### /static/filter.json
Information about Filters, among them we can mention: effective WaveLength, filter Width, fluxZero, sky transparency, tTel, tFilter, sky magnitude.

### [/index.php](https://github.com/LASalvador/Exposure-Time-Calculator/blob/master/index.php)
It is responsible for generating the routes and calling the homepage.

## WorkFlow of project 
The execution of the program begins with the file index.php, this will create all the routes to the system and will call the route responsible for calling the ETC home page. The Router understands the request of that route and calls the callback method associated with that route, this method is in the APPController class, the method associated with loading the homepage of the site is the home () method and this method loads the home.php page in the screen.

On the home page the user can choose which ETC to use, as a logic is equal for all ETCs will be explained only a working logic for an ETC - IAGPOL.

When clicking on ETC IAGPOL an HTTP request is triggered and this is interpreted by the Router class and calls the method associated with this request, which in this case is the method of the class APPController loadForm () it will load the ETC page that the user wants to use . So the ETC - IAGPOL page will be loaded on the user's screen.

After completing the form the user will click the button Calculate this button will generate an HTTP request that will be interpreted by the class Router that will call the callback method associated with this request, in this case will be the submitFormIAGPOL () method of the APPController class.

The submitFormIAGPOL () method is responsible for picking up all user inputs and generating system responses from them. All inputs in the ETC form generate a value except the choice of the CCD that generates a JSON with the serial number and mode of operation of the chosen CCD. After picking up the user input values all objects related to observation will be generated, such as: filter, cdd, instrument, sky and observation, detail that depending on the mode of operation the signal signal reason, integration time and polarization error are generated in a different way. In addition to these, the set of values for the graph is generated.

At this point all values have already been calculated and will be stored in a key-value associative Array and this array will be assigned to the server SESSION and finally the IAGPOL output page will be called, through an HTTP request.

The request is interpreted by the Router and it calls the loadOutput method in the APPController class, this method will load the view outputIAGPOL.php.

In the output screen, the graph is generated through the set of data retrieved from SESSION, then the response values of the calculations saved in the SESSION are taken and the values are shown to the user.
