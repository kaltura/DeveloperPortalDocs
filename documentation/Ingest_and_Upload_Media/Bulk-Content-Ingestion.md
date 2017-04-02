---
layout: page
title: Bulk Content Ingestion API
weight: 302
---

Kaltura offers bulk content ingenstion to support scenarios where you need to ingest a significant number of Internet accessible files - from more than a few to many files. Bulk upload presents a great advantage for consolidating large amounts of video content in different locations from remote sites. 

You can import multiple files per session using a simple comma separated CSV file, along with their basic metadata fields, or via an XML file, providing complete metadata and setting special configurations per entry.

With these options, you can also ingest files from your own FTP server, or any publicly accessible file server.

## Introduction Video  

The following video provides a quick walkthrough of the bulk-upload features in KMC:

{% onebox http://videos.kaltura.com/media/1_kxiv585x %}

## Bulk Upload Input Formats (CSV vs. XML)  

The benefits of using bulk upload to ingest your files include:

* Importing multiple files in one action, which automates automating the ingestion process
* Ingesting large-sized files that could otherwise take a long time when uploading from a desktop
* Automatically populating metadata fields in the same operation as ingesting the files

There are two methods for bulk-uploading of content:

* The simple method - using a [CSV formatted file](http://en.wikipedia.org/wiki/Comma-separated_values), which provides a quick and easy way to submit a list of files that you can create in a spreadsheet application like Microsoft Excel or Google Docs. Please note that the CSV format may only be used to upload/ingest new files into Kaltura.
* The robust method - using an [XML formatted file](http://en.wikipedia.org/wiki/XML), which provides a flexible structure for imputting complex metadata fields and other objects, such as caption files, and allows for more flexible ingestion workflows. The XML format supports full CRUD (Create, Read, Update, and Delete) operations with Kaltura Entries.

## How to Submit Bulk Upload Jobs  

1. Download the [sample CSV bulk upload file](https://cdnapisec.kaltura.com/content/docs/kaltura_batch_upload_falcon.zip).  
2. Review one of the following files:
  * CSV - Review the file named: kaltura_batch_upload_falcon.csv in the downloaded zip.
  * XML - Review the file named: kaltura_batch_upload_falcon.xml in the downloaded zip.

### Bulk Upload with CSV  

1. To specify the fields and their order in the CSV file, the first line in the CSV file should begin with an '\*'  (asterisk sign) followed by the list of field names, where each new field is separated by commas.
2. Lines with a ‘#’ (hash sign) are treated as comments, and will not be processed.  
3. Each line after the fields definition line (which begin with an ‘*’ sign) represents a Kaltura Entry to be ingested, and should include the values of every field defined above.  
4. All entry fields are processed according to the definition line and the order of the fields in the line.  

### Bulk Operations with XML  

The hierarchical structure enabled by XML allows for more flexibility to define a complete content package including all of the objects related to Kaltura Entry, the video source file, base and custom metadata, distribution profiles, transcoding flavors, thumbnails, caption assets, access control profiles, and more.   
With XML, you can achieve a simplified integration with other systems (for example, migrating media files including their complete metadata from lecture capture systems).   

1. In the XML format, the order of the fields is not important (since each field is defined atomically).  
2. Additionally, fields with an empty value can be skipped and not defined in the entry element.  
3. The structure and field names should respect that of the [Kaltura Bulk Upload XML Schema](https://developer.kaltura.com/api-docs/XML_Schemas/Bulk_Upload).

> If you're comfortable using PHP as a programming language, we recommend reviewing the GitHub project: [Kaltura's Bulk Upload XML Content Migration Sample Scripts](https://github.com/kaltura/kaltura-bulk-upload-migration-samples).


## The Bulk Upload Job API  

1. After you create the CSV or XML file that you want to submit for ingestion, call the [media.bulkUploadAdd action](https://developer.kaltura.com/api-docs/Execute_Bulk_Ingest_and_Updates/media_bulkUploadAdd) to execute the ingestion job.   
2. Once submitted, you can use the [bulk service](https://developer.kaltura.com/api-docs/Execute_Bulk_Ingest_and_Updates/bulk) to review the status of your ingestion job or to cancel it.   
