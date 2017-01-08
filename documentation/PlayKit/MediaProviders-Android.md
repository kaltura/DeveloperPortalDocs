

# MediaEntryProvider

Represents a component that capable of loading media data as PKMediaEntry representation.
The provider supports cancel of last executed load action.


Playkit suggests 3 implementation of media providers:
MockMediaProvider, KalturaOvpMediaProvider and PhoenixMediaProvider.

The Last 2 mentioned providers are remote providers and needs Internet connection.
Each load activation, freezes the current filled media data, and starts data loading and constructing operations.
The response to the load operation is passed to the calling component over the provided callback object.

Only 1 load action can run at a time. New load operation cancels previous working load if there's any.



## **MockMediaProvider**


MockMediaProvider can take as input, Json file or JsonObject, and entryId.
According to the entryId, a single entry can be selected, and considered as media data.


#### _JsonObject Input_

The JsonObject should contain the relevant properties needed to construct PKMediaEntry.
Input JsonObject can represents multiple entries provided as a map object contains key=EntryId value=entryJsonObject
or can represent a single media entry.


**JsonObject input can be created in one of the following ways:**


1. Manually create JsonObject and add its properties:

  ```
  JsonObject entries = new JsonObject();
  JsonObject mediaEntryJson = new JsonObject();
  mediaEntryJson.addProperty("id", id);
  mediaEntryJson.addProperty("name", name);
  mediaEntryJson.addProperty("duration", duration);
  mediaEntryJson.addProperty("mediaType", type);

  JsonArray sourcesArray = new JsonArray();
  JsonObject sourceObject = new JsonObject();
  sourceObject.addProperty("id", id);
  sourceObject.addProperty("url", url);

  JsonArray drm = new JsonArray();
  JsonObject drmData = new JsonObject();
  drmData.addProperty("licenseUri", license);
  drm.add(drmData);

  sourceObject.add("drmData", drmData);
  sourcesArray.add(sourceObject);
  mediaEntryJson.add("sources",  sourcesArray);

  entries.add(<EntryId>, mediaEntryJson);
```


2. Parsing a String representation of json data into JsonObject.

```
String entries = "{\n" +
        "  \"mp4\": {\n" +
        "    \"duration\": 102000,\n" +
        "    \"id\": \"1_1h1vsv3z\",\n" +
        "    \"name\": \"MP4: Kaltura Video Solutions for Media Companies\",\n" +
        "    \"sources\": [\n" +
        "      {\n" +
        "        \"id\": \"1_1h1vsv3z_mp4\",\n" +
        "        \"url\": \"https://cdnapisec.kaltura.com/p/2209591/sp/0/playManifest/entryId/1_1h1vsv3z/format/mpegdash/protocol/http/a.mp4\"\n" +
        "      }\n" +
        "    ]\n" +
        "  },\n" +
        "  \"dash\": {\n" +
        "    \"duration\": 102000,\n" +
        "    \"id\": \"1_1h1vsv3z\",\n" +
        "    \"name\": \"DASH: Kaltura Video Solutions for Media Companies\",\n" +
        "    \"sources\": [\n" +
        "      {\n" +
        "        \"id\": \"1_1h1vsv3z_dash\",\n" +
        "        \"url\": \"https://cdnapisec.kaltura.com/p/2209591/sp/0/playManifest/entryId/1_1h1vsv3z/format/mpegdash/protocol/http/a.mp4,\"\n" +
        "        \"drmData\": [\n" +
        "            {\n" +
        "              \"licenseUri\": \"licenseUri\"\n" +
        "            }\n" +
        "        ]\n" +
        "      }\n" +
        "    ]\n" +
        "  }\n" +
        "}";

JsonParser parser = new JsonParser();
JsonObject jsonObject = parser.parse(entries).getAsJsonObject();
```

#### _Json input file_

The input file content should be valid json format. Content can contain json object with multiple entries, or a single entry object.
Context should be provided in case input file is located under "assets" folder, otherwise, full path is needed.

_entries.json_
```
{
  "drm1": {
    "id": "0_pl5lbfo0",
    "sources": [
      {
        "id": "0_pl5lbfo0_dash",
        "url": "http://cdnapi.kaltura.com/p/1851571/sp/185157100/playManifest/entryId/0_pl5lbfo0/flavorIds/0_ywkmqnkg/format/mpegdash/protocol/http/a.mpd",
        "drmData": {
          "licenseUri": "https://udrm.kaltura.com/cenc/widevine/license?custom_data=eyJjYV9zeXN0ZW0iOiJPVlAiLCJ1c2VyX3Rva2VuIjoiZGpKOE1UZzFNVFUzTVh6NnJxM3hFYnI0aFBWU3N0ajRDaGtkT1NoVU1QYV9sTFFaNWpkSVdscWdYNld6YnJuSGZORHZ0V3hmYmExT3dJVmVjeXNIVTc3ci1VazBvWWZkaGttd0dZNWQwSmdCUGdfMkZ3Wi13cE1yRlE9PSIsImFjY291bnRfaWQiOiIxODUxNTcxIiwiY29udGVudF9pZCI6IjBfcGw1bGJmbzAiLCJmaWxlcyI6IjBfendxM2w0NHIsMF91YTYycms2cywwX290bWFxcG5mLDBfeXdrbXFua2csMV9lMHF0YWoxaiwxX2IycXp5dmE3In0%3D&signature=eFrsxqplBh6b8%2BRkn4XaLsKD7Lc%3D"
        }
      }
    ]
  },
  "dash": {
    "duration": 102000,
    "id": "1_1h1vsv3z",
    "name": "DASH: Kaltura Video Solutions for Media Companies",
    "sources": [
      {
        "id": "1_1h1vsv3z_dash",
        "mimeType": "application/dash+xml",
        "url": "http://cdnapi.kaltura.com/p/2209591/sp/0/playManifest/entryId/1_1h1vsv3z/format/mpegdash/protocol/http/a.mpd"
      }
    ]
  }
}
```

_singleEntry.json_
```
{
    "id": "0_pl5lbfo0",
    "sources": [
      {
        "id": "0_pl5lbfo0_dash",
        "url": "http://cdnapi.kaltura.com/p/1851571/sp/185157100/playManifest/entryId/0_pl5lbfo0/flavorIds/0_ywkmqnkg/format/mpegdash/protocol/http/a.mpd",
        "drmData": {
            "licenseUri": "https://udrm.kaltura.com/cenc/widevine/license?custom_data=eyJjYV9zeXN0ZW0iOiJPVlAiLCJ1c2VyX3Rva2VuIjoiZGpKOE1UZzFNVFUzTVh6NnJxM3hFYnI0aFBWU3N0ajRDaGtkT1NoVU1QYV9sTFFaNWpkSVdscWdYNld6YnJuSGZORHZ0V3hmYmExT3dJVmVjeXNIVTc3ci1VazBvWWZkaGttd0dZNWQwSmdCUGdfMkZ3Wi13cE1yRlE9PSIsImFjY291bnRfaWQiOiIxODUxNTcxIiwiY29udGVudF9pZCI6IjBfcGw1bGJmbzAiLCJmaWxlcyI6IjBfendxM2w0NHIsMF91YTYycms2cywwX290bWFxcG5mLDBfeXdrbXFua2csMV9lMHF0YWoxaiwxX2IycXp5dmE3In0%3D&signature=eFrsxqplBh6b8%2BRkn4XaLsKD7Lc%3D"
        }
      }
    ]
}
```

### Using MockMediaProvider:

```
// using input file
MockMediaProvider mockMediaProvider = new MockMediaProvider(InputFile, context, entryId);
OR
//using JsonObject
MockMediaProvider mockMediaProvider = new MockMediaProvider(JsonObject, entryId);


mockMediaProvider.load(new OnMediaLoadCompletion() {
        @Override
        public void onComplete(ResultElement<PKMediaEntry> response) {
            if(response.isSuccess()) {
                // response.getResponse() will contain the PKMediaEntry object
            } else {
                // media retrieval error: response.getError() will contain the error
            }
        }
});

```



## **OvpMediaProvider**
Remote media provider, working on OVP environments.
Use this provider when your content is OVP.

The media provider uses the supplied media parameters, to build the relevant Kaltura
OVP API requests, executes them, parse the responses and creates the PKMediaEntry object
for the current play.


#### _How to use:_

1. Create an instance of the KalturaOvpMediaProvider class.
2. Using setters, fill in, at least mandatory fields, in order to be able to construct
and execute the API requests.
Mandatory fields: [SessionProvider](https://github.com/kaltura/DeveloperPortalDocs/tree/playkit/documentation/PlayKit/SessionProviders.md) and EntryId.
3. Activate the providers "load" method, passing it an OnMediaLoadCompletion
callback object, in order to get the PKMediaEntry object.  

```
KalturaOvpMediaProvider mediaProvider = new KalturaOvpMediaProvider()
                                            .setSessionProvider(ovpSessionProvider)
                                            .setEntryId(NonDRMEntryId);

mediaProvider.load(new OnMediaLoadCompletion() {
    @Override
    public void onComplete(ResultElement<PKMediaEntry> response) {
        if(response.isSuccess()){
          // response.getResponse() will contain the PKMediaEntry object
        } else {
          // error occurred - check the response.getError() to check what happened.
        }
    }
});                                            
```


**_Optional fields:_**
* RequestQueue requestsExecutor - Implementation of the [RequestQueue](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/connect/RequestQueue.java) interface.
The executor gets RequestElement items passes them and return the response on the RequestElement
completion callback.
The Executor can be a mock executor for tests purposes or connect to a remote source and
pass the http requests. The default provided implementation, [APIOkRequestsExecutor](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/connect/APIOkRequestsExecutor.java), wraps the OKHttp3 http library for passing http requests.
* String uiConfId - If there is any, supply this data in order to provide it to the "playManifest" service
over the constructed playing url.


## **PhoenixMediaProvider**
Remote media provider, working on OTT Phoenix environments. Use this provider when your content is OTT.
This provider can be used also if your app is working with TVPAPI BE. The SessionProvider that
is used by the PhoenixMediaProvider should hold a valid Phoenix session token.
To make it easy, we've provided a SessionProvider implementation, [OttSessionProvider](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/backend/phoenix/OttSessionProvider.java), that creates,
validates and provides a valid Phoenix session token.

The media provider uses the supplied media parameters, to build the relevant Phoenix API
requests, executes them, parse the responses and creates the PKMediaEntry object
for the current play.


#### _How to use:_

1. Create an instance of the PhoenixMediaProvider class.
2. Using setters, fill in, at least the mandatory fields, in order to be able to construct
and execute the API requests.
Mandatory fields: [SessionProvider](https://github.com/kaltura/DeveloperPortalDocs/tree/playkit/documentation/PlayKit/SessionProviders.md), assetId, referenceType, and formats (at least 1).
3. Activate the providers "load" method, passing it an OnMediaLoadCompletion
callback object, in order to get the PKMediaEntry object.  

```
PhoenixMediaProvider mediaProvider = new PhoenixMediaProvider()
                                            .setSessionProvider(ottSessionProvider)
                                            .setReferenceType(APIDefines.AssetReferenceType.Media)
                                            .setAssetId(MediaId)
                                            .setFormats(FormatHD, FormatSD);

mediaProvider.load(new OnMediaLoadCompletion() {
    @Override
    public void onComplete(ResultElement<PKMediaEntry> response) {
        if(response.isSuccess()){
          // response.getResponse() will contain the PKMediaEntry object
        } else {
          // error occurred - check the response.getError() to check what happened.
        }
    }
});                                            
```


**_Optional fields:_**
* RequestQueue requestsExecutor - Implementation of the [RequestQueue](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/connect/RequestQueue.java) interface.
The executor gets RequestElement items passes them and return the response on the RequestElement
completion callback.
The Executor can be a mock executor for tests purposes or connect to a remote source and
pass the http requests. The default provided implementation, [APIOkRequestsExecutor](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/connect/APIOkRequestsExecutor.java), wraps the OKHttp3 http library for passing http requests.


## Creating PKMediaEntry for OTT tvpapi 

###Create the Media Source 

For each source

```
List<PKMediaSource> mediaSourceList = new ArrayList<>();
PKMediaSource pkMediaSource = new PKMediaSource();
pkMediaSource.setId(<FileId>);
pkMediaSource.setUrl(<Media URL>);
pkMediaSource.setMediaFormat(PKMediaFormat.getMediaFormat(<Media URL));

mediaSourceList.add(mediaSource); 
```
### In case of Widevine Media - DRM License is required

```
List<PKDrmParams> pkDrmDataList = new ArrayList<>();
PKDrmParams pkDrmParams = new PKDrmParams(licenseUrl);
pkDrmDataList.add(pkDrmParams);
pkMediaSource.setDrmData(pkDrmDataList);
```

###Create the Media Entry

```
PKMediaEntry mediaEntry = new PKMediaEntry();
mediaEntry.setId(<MediaId>)
mediaSourceList.add(pkMediaSource);
mediaEntry.setSources(mediaSourceList);
mediaEntry.setDuration(mediaDuration);

```


#### Once the PKMediaEntry is ready, you can start configuring the player.
