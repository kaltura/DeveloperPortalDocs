---
layout: page
title: Uploading Media using the Kaltura Developer API Console
---

## Starting a Kaltura Session  

<span>Complete the steps as described in <a href="{{site.url}}/documentation/Knowledge/how-start-kaltura-session-using-testme-console.html">How to Start a Kaltura Session using the TestMe Console</a></span>

https://developer.kaltura.com/api-docs/#/uploadToken

<p id="UploadingMediawiththeAPI-UploadingMediaUsingtheAPI:" class="mce-procedure">
  To Upload Media Using the API
</p>

1.  In the TestMe console, choose **UploadToken** as the service and **Add** as the action.  
    <img src="../../assets/2294.img">
      
    
2.  Click S**end**  and copy the ID of the token that is created to the clipboard.  
    <img src="../../assets/2295.img">
     
3.  After the upload token is created you will beed to add a file to the token. Change the action to **upload**, paste the TokenID  saved from the last step, and click  **Choose file.  
    <img src="../../assets/2296.img">
      
    
4.  Choose the file you want  to upload and click **Open**.  
    <img src="../../assets/2297.img">
     
5.  After choosing the file, click **sSend**. You should be able to see the feedback on the right side of the screen.  
    <img src="../../assets/2298.img">
    <img src="../../assets/2299.img">
      
    
6.  After creating the upload token you then need to create a new entry.  
    <img src="../../assets/2300.img">
      
    
7.  Choose a name for the entry and a ebter values for other  optional fields. Yyou must choose a **media type. ** Press **Send** at the end.  
    <img src="../../assets/2301.img">
      
    
8.  Save the Entry ID, we will use it later.  
    <img src="../../assets/2302.img">
     
9.  After creating the entry, you will need to add content to the entry using the upload token you created in the earlier steps:<ol style="list-style-type: lower-alpha;">
      <li>
        Change the action to <strong>AddContent</strong>.
      </li>
      <li>
        Paste the <strong>entry ID </strong>of the entry you created.
      </li>
      <li>
        Choose <strong>KalturaUploadedFileTokenResource</strong> from the Resource drop down list.
      </li>
      <li>
        Press <strong>Edit</strong>, and paste the Token ID you created.
      </li>
      <li>
        Press <strong>Send</strong>.<br /><img src="../../assets/2303.img">
      </li>
    </ol>
    
    Log in to the KMC and search for the new entry.
