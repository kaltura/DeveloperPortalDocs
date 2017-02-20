---
layout: page
title: "Access Control and Content Retrieval on Connected Devices"
---

<p>
    Kaltura has two different mechanisms that enforce access control without cross-dependency: <span style="color: #000000;">that are effective for all connected devices.</span>
  </p>
  
  <ul>
    <li>
      <a href="#Scheduling">Scheduling</a>
    </li>
    <li>
      <a href="#Advanced">Advanced Access Control </a>
    </li>
  </ul>
  
  <p>
    <a name="Scheduling"></a>Scheduling – Used for enforcing access control on the entry-level across all connected devices. This mechanism is based on a single start/end window. It is recommended to use the scheduling mechanism if and when it meets your business requirements. Scheduling is easier to setup via the API and can be<span style="color: #000000;"> self-served by non-technical users, either through the KMC or through MediaSpace.</span>
  </p>
  
  <p>
    <br /><span style="color: #000000;"><a name="Advanced"></a>Advanced Access Control – Used for more fine-grain control, on the flavor level, and allows both multiple-scheduling windows and multiple rules beyond scheduling. For example (“Don’t serve the HD flavor in Canada”, “Playback on iPads is not allowed 8 hours after TV air date”). This mechanism is more complex. Additional information is available in the article <a href="%20http://kc-public.kaltura.com/kaltura-media-access-control-model#device-specific" target="_blank"><span style="color: #000000;">The Kaltura Media Access Control Model</span></a>.</span>
  </p>
  
  <p>
    Both Scheduling and Advanced Access-Control are fully enforced on the server-side and by mobile applications when they retrieve content via Kaltura APIs. For more information on how to retrieve content per platform/protocol see <a href="{{site.url}}/documentation/Knowledge/how-retrieve-download-or-streaming-url-using-api-calls.html" target="_blank">How to retrieve the download or streaming URL using API calls?</a>
  </p>
  
  <p>
    <a href="{{site.url}}/documentation/Knowledge/how-retrieve-download-or-streaming-url-using-api-calls.html" target="_blank"></a>It is recommended to always use these methods and not, for example, store returned m3u8 urls, as m3u8 urls are only temporary.
  </p>
  
  <p>
    When using the scheduling mechaism, setting the scheduling window on an entry, either via KMC, or via API, will have the access control logic enforced cross-device.
  </p>
  
  <p>
    To provide a better UX than just a black screen when accessing content outside its scheduling window, for example, display a message as “This video cannot be played at this time” or “Video can only be accessed between X – Y, try again in T hours”, you should also use the <a href="https://developer.kaltura.com/api-docs/#/baseEntry.getContextData">baseEntry.getContextData</a> API method. This method allows retrieving the scheduling window and presenting a message dialog to the end user when <a href="https://developer.kaltura.com/api-docs/#/KalturaEntryContextDataResult">isScheduledNow</a> is returned false.
  </p>
