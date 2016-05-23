---
layout: page
title: Bulk Content Ingestion API
weight: 302
---

Kaltura offers bulk content ingenstion to support scenarios where you need to ingest more than a few to large number of internet accessible files. Bulk upload presents a great advantage to consolidate large amounts of video content in different locations from remote sites.  
You can import multiple files per session via a simple comma separated file (CSV) along with their basic metadata fields or via an XML file providing complete metadata and even setting special configuraitons per entry.  
With these options, you can also ingest files from your own FTP server, or any publicly accessible file's server.

## Introduction Video

The following video provides a quick walkthrough of the bulk-upload features in KMC - 

{% onebox http://www.kaltura.com/tiny/yu1ms %}

## Bulk Upload Inpur Formats (CSV vs. XML)

The benefits of using bulk upload to ingest your files:

* Importing multiple files in one action thus automating the ingestion process.
* Ingesting large-sized files that could otherwise take long time from the desktop.
* Automatically populating metadata fields at the same operation of ingesting the files.

There are two methods to bulk-upload content:

* The simple method - using a [CSV formatted file](http://en.wikipedia.org/wiki/Comma-separated_values), providing a quick and easy way to submit list of files one can even create in a spreadsheet application like Microsoft Excel or Google Docs. The CSV format may only be used to upload/ingest new files into Kaltura.
* The robust method - using an [XML formatted file](http://en.wikipedia.org/wiki/XML), providing flexible structure to input complex metadata fields and other objects such as caption files, allowing for more flexible ingestion workflows. The XML format supports full CRUD (Create, Read, Update, and Delete) operations with Kaltura Entries.

## How to submit bulk upload jobs

Download the [Sample CSV Bulk Upload file](https://cdnapisec.kaltura.com/content/docs/kaltura_batch_upload_falcon.zip).  

* CSV - Review the file named: kaltura_batch_upload_falcon.csv in the downloaded zip.
* XML - Review the file named: kaltura_batch_upload_falcon.xml in the downloaded zip.

### Bulk upload with CSV

To specify the fields and their order in the CSV file, the first line in the CSV file should start with an '\*'  (asterisk sign) followed by the list of field names, each new field separated by a commas.   
Lines with a ‘#’ (hash sign) are treated as comments, and will not be processed.  
Each line after the fields definition line (which starts with an ‘*’ sign) represents a Kaltura Entry to be ingested and should include the values of every field defined above.  
All entry fields are processed according to the definition line and the order of the fields in it.  

### Bulk operations with XML

The hierarchical structure enabled by XML allows for more flexibility to define a complete content package including all of the objects related to Kaltura Entry, including the video source file, base and custom metadata, distribution profiles, transcoding flavors, thumbnails, caption assets, access control profiles, and more.   
With XML, you can achieve a simplified integration with other systems (for example, migrating media files including their complete metadata from lecture capture systems).   

In the XML format the order the fields is not important (since each field is defined atomically).  
Additionally, fields with empty value can simply be skipped and not defined in the entry element.  
The structure and field names respect that of the [Kaltura Bulk Upload XML Schema](https://developer.kaltura.com/api-docs/#/Bulk%20Upload).

If you're comfortable with PHP as a programming language, we recommend reviewing the GitHub project: [Kaltura's Bulk Upload XML Content Migration Sample Scripts](https://github.com/kaltura/kaltura-bulk-upload-migration-samples).


## The bulk upload job API

After you've created the CSV or XML file you wish to submit for ingestion, call the [media.bulkUploadAdd action](https://developer.kaltura.com/api-docs/#/media.bulkUploadAdd) to execute the ingestion job.   
Once submitted, you can use the [bulk service](https://developer.kaltura.com/api-docs/#/bulk) to review the status of your ingestion job or abort it.   
