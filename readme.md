# Hotel Task
We constantly dealing with a big amount of hotel data. The objective of this task is to code a tool that converts data from any potential format into CSV.



### Task 1 - PHP

Your code needs to fulfill the following requirements:

1. Your solution should be implemented in PHP 7.0+ Of course, you can use any publicly available framework or library to get the job done. The only constraint is that your application needs to run on our local machine (see below how we will run your code).
2. In the resources section, you can find a JSON file and an XML file which you can use as a data source. 
3. Your code should be able to convert these formats into CSV. 
4. Validate the data. To keep it simple, please follow these rules:
A hotel name may not contain non-ASCII characters.
The hotel URL must be valid (please come up with a good definition of "valid").
Hotel ratings are given as a number from 0 to 5 stars (never negative numbers).
5. Provide unit and/or integration tests for your code.


### Bonus tasks

If you find additional time here are some extra options you might consider. These are optional to your submission.

- Make the tool is easily extensible to new input formats.
- We care more about code quality (readability, software architecture) than code performance - although fast execution is a plus.
- Generate a log file to let potential users know how they could improve data quality.
- Add options to sort/group/filter the data before writing it to the output file.
- Feel free to add more, useful validation rules.

___

**The task made as laravel service provider, Please follow the instructions to run the code.**  
  
# instructions  
  
1. Install Laravel [https://laravel.com/docs/5.5/installation].  
  
2. Setup
  
    2.1. Copy `/hotels` to project root.  
      
    2.2. Copy `HotelServiceProvider.php` to `app\Providers` folder.  
  
    2.3. To the array `providers` in `config/app.php` add   
          
       App\Providers\HotelServiceProvider::class,  
  
	2.4. To `autoload` => `psr-4` in `composer.json` add  
      
        "Hotels\\": "hotels/"  
        
	2.5. in your terminal run   
      
        composer dump-autoload  
       
	2.6. Create `data` folder inside `/storage/app/`,   
    then inside `/storage/app/` create `input` and `output` folders    
    then `.env` file and add this two lines:       
    
		 INPUT_DIR=app/data/input 
		 OUTPUT_DIR=app/data/output  

	and put your input files in `/storage/app/data/input`.  
  
     2.7. Copy files of `\tests\Unit` folder  to `tests\Unit` folder.      

#### Run and Export:
  
   From your browser, visit:  
          
        http://localhost/.../public  
  
  
#### Run Tests:  

From your terminal run:  
      
        php vendor/phpunit/phpunit/phpunit  
  
##  Application Short Description

Once the application is run, it gathering source files from the ​**input** ​folder,
It can read data from ​**CSV, JSON and XML**​ file,
And convert it to ​**CSV, JSON, XML and HTML**​ files.

Application validate that ​**hotel name**​ not contain ​non-ASCII​ characters
The hotel ​**URL​, ​stars​, ​phone ​number** is valid

**Filter** ​available with ​**stars**,

And ​**Sorting** ​available with ​**stars** ​and ​**hotel names**​.

And application ​**Logs** ​the invalid hotels data into ​`\storage\logs\laravel.log`.


## Folders & Files Description

**\app\Providers\HotelServiceProvider.php**:
the file containing the hotel service provider and validator of none-ascii and
phone number validation.

**\hotels**​: this folder contains all about the task interfaces, controllers, service and etc.
- **Contracts**​: interfaces for both of reader and writer
- **Controllers**​: hotel controller
- **Exceptions**​: exceptions files
- **Libs**​: this folder contain readers adapter, abstract, classes files for
both of readers and writers
- **routes**​:
- **Services**​: contain files of filter and sorter traits
- **views**​: view file
- **Hotel.php**


**\storage\app\data**
- **input**​: data source files
- **output**​: exported files

**\storage\logs\laravel.log**​: where the application logs the invalid hotels, errors,
warnings etc.

**\tests**​: contain the application tests.