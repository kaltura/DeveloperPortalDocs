---
layout: page
title: Kaltura's Remote Storage Configuration and Information Guide
---

<p class="mce-heading-2">
  Kaltura’s Remote Storage – Configuration Options
</p>

While the majority of Kaltura’s customers choose the Kaltura-hosted SaaS solution for its many benefits, some customers are required to comply with specific regulations, have unique architecture considerations, or, have other needs that propel them towards deploying parts of the solution locally in  “hybrid variations”. These variations allow customers to meet their unique requirements while providing a cost effective alternative to a fully customer-hosted solution. These variations use the Kaltura SaaS management component to manage video assets and account settings, while storage and delivery components are hosted by the customer.

This article specifies which assets can be stored and served locally, or from the customer’s own CDN, as well as few limitations that are associated with hybrid solution.

<p class="mce-heading-3">
  Remote Storage – What can be exported and stored on the customer’s storage of choice?
</p>

<table style="width: 792px;" border="1" cellspacing="0" cellpadding="0">
  <thead>
    <tr>
      <td valign="top" width="248">
        <p class="TableHeading">
          Item
        </p>
      </td>
      
      <td valign="top" width="543">
        <p class="TableHeading">
          Where can it be stored?
        </p>
      </td>
    </tr>
  </thead>
  
  <tbody>
    <tr>
      <td valign="top" width="248">
        <p class="TableBodyText">
          Video / Audio assets (source, transcoded flavors)
        </p>
      </td>
      
      <td valign="top" width="543">
        <p class="TableBodyText">
          Kaltura’s DC or customer’s storage of choice.
        </p>
      </td>
    </tr>
    
    <tr>
      <td valign="top" width="248">
        <p class="TableBodyText">
          Image entry
        </p>
      </td>
      
      <td valign="top" width="543">
        <p class="TableBodyText">
          Kaltura’s DC only.
        </p>
      </td>
    </tr>
    
    <tr>
      <td valign="top" width="248">
        <p class="TableBodyText">
          Thumbnails
        </p>
      </td>
      
      <td valign="top" width="543">
        <p class="TableBodyText">
          Kaltura’s DC only.
        </p>
      </td>
    </tr>
    
    <tr>
      <td valign="top" width="248">
        <p class="TableBodyText">
          Caption files
        </p>
      </td>
      
      <td valign="top" width="543">
        <p class="TableBodyText">
          Kaltura’s DC only.
        </p>
      </td>
    </tr>
    
    <tr>
      <td valign="top" width="248">
        <p class="TableBodyText">
          Related files
        </p>
      </td>
      
      <td valign="top" width="543">
        <p class="TableBodyText">
          Kaltura’s DC only.
        </p>
      </td>
    </tr>
    
    <tr>
      <td valign="top" width="248">
        <p class="TableBodyText">
          Meta-data
        </p>
      </td>
      
      <td valign="top" width="543">
        <p class="TableBodyText">
          Kaltura’s DC only.
        </p>
      </td>
    </tr>
    
    <tr>
      <td valign="top" width="248">
        <p class="TableBodyText">
          SWF files (players, widget’s, KMC etc.)
        </p>
      </td>
      
      <td valign="top" width="543">
        <p class="TableBodyText">
          Kaltura’s DC or Customer CDN*
        </p>
        
        <p class="TableBodyText">
          * Will require advanced settings
        </p>
      </td>
    </tr>
    
    <tr>
      <td valign="top" width="248">
        <p class="TableBodyText">
          HTML5 library
        </p>
      </td>
      
      <td valign="top" width="543">
        <p class="TableBodyText">
          Kaltura’s DC or Customer CDN*
        </p>
        
        <p class="TableBodyText">
          * Will require advanced settings
        </p>
      </td>
    </tr>
    
    <tr>
      <td valign="top" width="248">
        <p class="TableBodyText">
          API endpoints
        </p>
      </td>
      
      <td valign="top" width="543">
        <p class="TableBodyText">
          Kaltura’s DC via CDN.
        </p>
      </td>
    </tr>
  </tbody>
</table>

<span class="mce-note-graphic">Kaltura does not export caption files, thumbnails and related files. It is possible to serve them from a remote location. To do so, you will need to  push the content to its final location, and use Kaltura’s API (or XML ingestion) to update the path at Kaltura.</span>

<p class="mce-heading-3">
  Configuring your own CDN / Streaming Server
</p>

It is also possible to configure your own CDN / streaming server instead of using Kaltura’s default CDN account. The elements listed in the following table are served:

<table style="width: 792px;" border="1" cellspacing="0" cellpadding="0">
  <thead>
    <tr>
      <td valign="top" width="248">
        <p class="TableHeading">
          Item
        </p>
      </td>
      
      <td valign="top" width="543">
        <p class="TableHeading">
          How can it be served?
        </p>
      </td>
    </tr>
  </thead>
  
  <tbody>
    <tr>
      <td valign="top" width="248">
        <p class="TableBodyText">
          Video / Audio assets (source, transcoded flavors)
        </p>
      </td>
      
      <td valign="top" width="543">
        <p class="TableBodyText">
          Kaltura’s CDN* ; Customer’s BYO CDN** ; customer’s streaming server**. 
        </p>
        
        <p class="TableBodyText">
          * Only when using Kaltura’s storage.
        </p>
        
        <p class="TableBodyText">
          ** To check if a specific CDN or streaming server is supported, please contact your Kaltura representative, or customer care.
        </p>
      </td>
    </tr>
    
    <tr>
      <td valign="top" width="248">
        <p class="TableBodyText">
          Image entry
        </p>
      </td>
      
      <td valign="top" width="543">
        <p class="TableBodyText">
          Kaltura’s CDN or Customer’s BYO CDN
        </p>
      </td>
    </tr>
    
    <tr>
      <td valign="top" width="248">
        <p class="TableBodyText">
          Thumbnails
        </p>
      </td>
      
      <td valign="top" width="543">
        <p class="TableBodyText">
          Kaltura’s CDN or Customer’s BYO CDN
        </p>
      </td>
    </tr>
    
    <tr>
      <td valign="top" width="248">
        <p class="TableBodyText">
          Caption files
        </p>
      </td>
      
      <td valign="top" width="543">
        <p class="TableBodyText">
          Kaltura’s CDN or Customer’s BYO CDN
        </p>
      </td>
    </tr>
    
    <tr>
      <td valign="top" width="248">
        <p class="TableBodyText">
          Related files
        </p>
      </td>
      
      <td valign="top" width="543">
        <p class="TableBodyText">
          Kaltura’s CDN or Customer’s BYO CDN
        </p>
      </td>
    </tr>
    
    <tr>
      <td valign="top" width="248">
        <p class="TableBodyText">
          SWF files (players, widget’s, KMC etc.)
        </p>
      </td>
      
      <td valign="top" width="543">
        <p class="TableBodyText">
          Kaltura’s CDN or Customer’s BYO CDN*
        </p>
        
        <p class="TableBodyText">
          * Requires advanced configuration
        </p>
      </td>
    </tr>
    
    <tr>
      <td valign="top" width="248">
        <p class="TableBodyText">
          HTML5 library
        </p>
      </td>
      
      <td valign="top" width="543">
        <p class="TableBodyText">
          Kaltura’s CDN or Customer’s BYO CDN*
        </p>
        
        <p>
          *Requires advanced configuration
        </p>
      </td>
    </tr>
    
    <tr>
      <td valign="top" width="248">
        <p class="TableBodyText">
          API endpoints
        </p>
      </td>
      
      <td valign="top" width="543">
        <p class="TableBodyText">
          Kaltura’s CDN.
        </p>
      </td>
    </tr>
  </tbody>
</table>

 <span class="mce-note-graphic">If a 3rd party CDN is used, it is applied on all applicable items. Partial set up is not available.</span>

When exporting flavor assets of a video or audio file to remote storage, Kaltura can keep a copy of the file on its own cloud (for backup, dual delivery, etc.) or delete it after the file is exported to the remote storage.

While it is possible to selectively choose the file formats (flavors) that are exported to the remote storage, the “delete after export” policy is implmeneted across the entire account.

<h2 class="mce-heading-3">
  <span class="mce-heading-2">Storing the Source File</span>
</h2>

Kaltura recommends keeping the source file stored on Kaltura’s cloud (and not to export and delete it). If you choose not to do so, the following features will not be available:

*   **Thumbnail API** – the option to generate thumbnails on the fly, through Kaltura’s thumbnail API.
*   **Re- transcoding / adding new flavors** –retranscoding the entry in case of any issues, or generating additional flavors (formats) in the future.
*   **Clipping and Trimming**
*   **Distribution connectors - **Some distribution connectors require pushing the physical file to an API or to an FTP end point. Setting up those distribution connectors won’t be possible without keeping the relevant physical files in Kaltura. 

<p class="mce-note-graphic">
  <span>The thumbnail API can be powered by a flavor other than the source that is stored in Kaltura. Thus allowing the creation of thumbnails from low-resolution video, while saving on storage. This option requires additional customization, to mark the flavor accordingly, and not to export it to the remote storage. </span>
</p>

<p class="mce-heading-2">
  Analytics
</p>

When a customer uses their own storage and / or CDN, analytics information related to storage and bandwidth usage is not updated in the KMC. Other analytical reports such as plays, user engagement etc. work as they should.

<h2 class="mce-heading-2">
  Remote Storage Configuration Workflow
</h2>

The following diagram illustrates a few of the ramifications for the chosen selections:

<img src="../../assets/1601.img">

 

 
