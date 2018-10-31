# Getting Started 
 
This guide will enable you to quickly and easily get started with building your own video experiences and exploring the platform’s basic capabilities.
 
## Before You begin
 
You will need your Kaltura account credentials. If you don’t have them yet, start a [free trial](https://vpaas.kaltura.com/register).
If you’ve signed in, you can click on your account info at the top right of this page to view your credentials.
You can also find them at any time in the KMC's (Kaltura Management Console) by clicking the [Integration Settings tab](https://kmc.kaltura.com/index.php/kmcng/settings/integrationSettings).
 
The simplest way to make requests to the Kaltura REST API is by using one of the [Kaltura API Client Libraries](https://developer.kaltura.com/api-docs/Client_Libraries/). We don’t recommend making REST API requests directly, as your URL requests might get really long and tricky. 
 
Once you’ve downloaded the client library, you'll need to import the library and instantiate a KalturaClient object with which you'll make calls to the API. 
Setup looks like this:

{% code_example setup %}
 
## Kaltura Session
 
Because the Kaltura API is stateless, every request made to the API requires an authentication session to be passed along with the request. With the client library, it’s easy to set it once using the [`session.start`](https://developer.kaltura.com/console/service/session/action/start) API action, like this:

{% code_example session %}

*Specifying an `app id` which contains the name and domain of the app allows you to get specific analytics per application, for cases where you’re running your application on various domains.*

Try it interactively [with this workflow](https://developer.kaltura.com/workflows/Generate_API_Sessions/Authentication). 

Generating a KS with `session.start` is simple, and great for applications which you alone have access to. 
Other methods include the `user.loginByLoginId` action, which allows users to log in using their own KMC credentials, and the `appToken` service, which is recommended when providing access to applications in production that are managed by others. 
Learn more [here](https://developer.kaltura.com/api-docs/VPaaS-API-Getting-Started/Generating-KS-with-App-Tokens.html/) about various ways to create a Kaltura Session.

 
## Uploading Media Files
Kaltura is built to handle files of all types and size. To best handle the upload of large files, Kaltura's upload API provides the ability to upload files in smaller chunks, in parllel (multiple chunks can be uploaded simultaneously to improve network utilization), as well as pause-and-resume and chunk upload retrys in case of temporary network failures.
 
**Step 1: Create an Upload Token**

You’ll use [`uploadToken.add`](https://developer.kaltura.com/console/service/uploadToken/action/add) to create an uploadToken for your new video.

{% code_example media1 %}

An UploadToken is essentially a container that holds any file that will be uploaded to Kaltura. The token has an ID that is attached to the location of the file.  This process allows the upload to happen independently of the entry creation. In the case of large files, for example, the same uploadToken ID is used for each chunk of the same file.

### About Chunked File Uploading

How it works: 
- On the client side of the app, the file is chunked into multiple fragments (of adjustable size)
- The chunks are then uploaded to Kaltura storage (in some cases simultaneously)
- Once all the chunks have arrived, they are assembled to form the original file [on the server side] so that file processing can begin

Kaltura has three widgets that you can use for chunked uploading:
- [JS Library](https://github.com/kaltura/kaltura-parallel-upload-resumablejs) (supports parallel uploading)
- [Java Library](https://github.com/kaltura/Sample-Kaltura-Chunked-Upload-Java) (supports parallel uploading)
- [jQuery Library](https://github.com/kaltura/chunked-file-upload-jquery) (for jQuery based applications)

To upload manually, continue following the steps: 

**Step 2: Upload the File Data**

We’ll call [`uploadToken.upload`](https://developer.kaltura.com/console/service/uploadToken/action/upload) to upload a new video file using the newly created token. If you don't have a video file handy, you can right-click [this link](http://cfvod.kaltura.com/pd/p/811441/sp/81144100/serveFlavor/entryId/1_2bjlk7qb/v/2/flavorId/1_d1ft34uv/fileName/Kaltura_Logo_Animation.flv/name/a.flv) to save a sample video of Kaltura's logo. In the case of large files, `resume` should be set to `true` and `finalChunk` is set to `false` until the final chunk. `resumeAt` determines at which byte to chunk the next fragment. 

{% code_example media2 %}

**Step 3: Creating the Kaltura Media Entry**

Here’s where you’ll set your video’s name and description use [`media.add`](https://developer.kaltura.com/console/service/media/action/add) to create the entry.

{% code_example media3 %}

The Kaltura Entry is a logical object that package all of the related assets to the uploaded file. The Media Entry represents Media assets (such as Image, Audio, or Video assets) and references all of the metadata, caption assets, transcoded renditions (flavors), thumbnails, access control rules, entitled users or any other related asset that is a part of that particular media item.


**Step 4: Attach the Video**

Now that you have your entry, you need to associate it with the uploaded video token using [`media.addContent`](https://developer.kaltura.com/console/service/media/action/addContent). 

{% code_example media4 %}

At this point, Kaltura will start analyzing the uploaded file, prepare for the transcoding and distribution flows and any other predefined workflows or notifications.

## Searching Entries 
To retrieve that newly uploaded entry, we'll use the [Kaltura Search API](https://developer.kaltura.com/console/service/eSearch/action/searchEntry). 

**Step 1: Params and Operator**
If you have multiple search conditions, you would set an `AND` or `OR` to your operator, but in this case we’ll only be searching for one item. However, you still need to add a searchItems array to the operator. 

{% code_example search1 %}

**Step 2: Search Type**

We'll be using the Unified search, which searches through all entry data, such as metadata and captions. Other options are `KalturaESearchEntryMetadataItem` or `KalturaESearchEntryCuePointItem`. We'll add that search item to the first index of the search operator.

{% code_example search2 %}

**Step 3: Search Term**

We'll search for the kaltura logo sample video, which we named accordingly.

{% code_example search3 %}

**Step 4: Search Item Type**

In this case, we want an exact match of the text in our search term. Other options are `partial` or `startsWith`. 

{% code_example search4 %}

**Step 5: Add Highlight**

We set `addHighlight` to True so that we can see exactly where our search term appeared in the search results. 

{% code_example search5 %}

**Step 6: Search**

{% code_example search6 %}

Success! The result will return as a list of  `KalturaMediaEntry` objects. 

## Embedding Your Video Player 
You have your entry ID, so you’re just about ready to embed the kaltura player, but first you’ll need a `UI Conf ID`, which is basically the ID of the player in which the video is shown. 
For this you’ll need to log into the KMC and click on the [Studio](https://kmc.kaltura.com/index.php/kmcng/studio/v2) tab. 

Notice that there are two studio options: TV and Universal. 
The Universal player (or mwEmbed as we call it) offers legacy support - such as for enterprise customers using the old internet explorer - and also features interactivity options, like the dual player or In-Video Quizzes. 
The TV player (or playkit) is built on modern javascript and focuses more on performance. Both players are totally responsive. 

We will focus on the TV player: 

1. Create a new TV player, give it a name, and check out the various player options.
2. Save the player and go back to players list; you should now see it the top of the player list. Notice that player ID - that is your `UI Conf ID`. 
Now you can use it for embedding your player:

**Dynamic Player Embed**
```
<script type="text/javascript">
		var kalturaPlayer = KalturaPlayer.setup({
			targetId: "kalturaplayer",
			provider: {
				partnerId: PARTER_ID,
				uiConfId: UI_CONF_ID
			},
			playback: {
				autoplay: true
			}
		});
		var mediaInfo = {
			entryId: ENTRY_ID,
			ks: KS
		};
		kalturaPlayer.loadMedia(mediaInfo);
	</script>
```
Learn about other embed types [here.](https://github.com/kaltura/kaltura-player-js/blob/master/docs/embed-types.md)

## Wrapping Up 

Including a kaltura session allows you to keep track of user analytics for each entry and set permissions and privileges. Notice that in this case, the KS is created on the server side of the app. 

**Congrats! You’ve learned how to:**
- Create a kaltura session 
- Upload media to your Kaltura account 
- Search for your media
- Show your media in a Kaltura Player 

**Next steps:** 
- Read the eSearch [blog post](https://corp.kaltura.com/blog/introducing-esearch-the-new-kaltura-search-api/)
- Learn how to create and handle [thumbnails](https://developer.kaltura.com/api-docs/Engage_and_Publish/kaltura-thumbnail-api.html/)
- Analyze Engagement [Analytics](https://developer.kaltura.com/api-docs/Video-Analytics-and-Insights/media-analytics.html)

You can learn more about these steps in our [docs](https://developer.kaltura.com/api-docs/), play around in the [console](https://developer.kaltura.com/console), or enjoy full interactive experiences with our [workflows](https://developer.kaltura.com/workflows). 

And of course, feel free to reach out at vpaas@kaltura.com if you have any questions.

