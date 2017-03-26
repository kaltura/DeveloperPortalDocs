---
layout: page
title: Connecting Services
subcat: SDK 3.0 - Android
weight: 294
---

This article describes how to connect services using the Kaltura Backend.

## Media Provider

This article describes the steps required for using the Kaltura Analytics Plugin on Android devices as well as the events supported by the plugin. Adding the Kaltura Analytics Plugin will enable you get detailed analytics. 

The Media Entry Provider is a component that is capable of loading media data as a PKMediaEntry representation. The provider supports the cancellation of the last executed load action.

## Implementation Options  

Playkit offers three implementations of media providers: *MockMediaProvider*, *KalturaOvpMediaProvider*, and *PhoenixMediaProvider*.

*KalturaOvpMediaProvider* and *PhoenixMediaProvider* are remote providers and require an Internet connection. Each load activation freezes the current filled media data, and starts data loading and constructing operations. The response to the load operation is passed to the calling component over the provided callback object.

>Note: Only one load action can run at a time. A new load operation cancels the previous working load if one is ongoing.


## MockMediaProvider  

The MockMediaProvider can take as an input a JSON file, or JsonObject, and entryId.
According to the entryId, a single entry can be selected, and considered as media data.


#### _JsonObject Input_  

The JsonObject should contain the relevant properties needed to construct the PKMediaEntry. The Input JsonObject can represents multiple entries provided as a map object containing a key=EntryId value=entryJsonObject or can represent a single media entry.


**JsonObject input can be created in one of the following ways:**

1 . Manually create a JsonObject and add its properties:

```java
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

2 . Parsing a string representation of JSON data into JsonObject:

```java
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

The input file content should have a valid JSON format. Content can contain a JSON object with multiple entries, or a single entry object. Context should be provided in case the input file is located under "assets" folder; otherwise, the full path is required.

_entries.json_
  
```json
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

```json
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

### Using MockMediaProvider

```json
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

## OvpMediaProvider  

The OvpMediaProvider is a remote media provider that works on OVP environments. Use this provider when your content is OVP.

The media provider uses the supplied media parameters to build the relevant Kaltura OVP API requests, executes them, parse the responses and creates the PKMediaEntry object for the current play.

To use this provider:

1. Create an instance of the KalturaOvpMediaProvider class.
2. Using setters, fill in at least the mandatory fields to be able to construct and execute the API requests.
3. Activate the providers "load" method, passing it an OnMediaLoadCompletion callback object, in order to get the PKMediaEntry object.  

```java
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
The executor gets RequestElement items, passes them, and returns the response on the RequestElement
completion callback.
The executor can be a mock executor for test purposes or connect to a remote source and pass the http requests. The default provided implementation, [APIOkRequestsExecutor](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/connect/APIOkRequestsExecutor.java), wraps the OKHttp3 http library for passing http requests.
* String uiConfId - If there is any, supply this data to provide it to the "playManifest" service over the constructed playing url.


## PhoenixMediaProvider  

This is a remote media provider that works on OTT Phoenix environments. Use this provider when your content is OTT.
This provider can be used also if your application is working with TVPAPI BE. The SessionProvider that
is used by the PhoenixMediaProvider should hold a valid Phoenix session token.
To make it easy, we've provided a SessionProvider implementation, [OttSessionProvider](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/backend/phoenix/OttSessionProvider.java), that creates,
validates, and provides a valid Phoenix session token.

The media provider uses the supplied media parameters, to build the relevant Phoenix API requests, execute them, parse the responses and create the PKMediaEntry object for the current play.

To use this provider:

1. Create an instance of the PhoenixMediaProvider class.
2. Using setters, fill in at least the mandatory fields to be able to construct and execute the API requests (assetId, referenceType, and formats; at least 1).
3. Activate the providers "load" method, passing it an OnMediaLoadCompletion callback object to get the PKMediaEntry object.  

```java
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
The executor gets RequestElement items, passes them, and returns the response on the RequestElement
completion callback.
The executor can be a mock executor for test purposes or connect to a remote source and pass the http requests. The default provided implementation, [APIOkRequestsExecutor](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/connect/APIOkRequestsExecutor.java), wraps the OKHttp3 http library for passing http requests.


## Creating PKMediaEntry for OTT TVPAPI  

### Create the Media Source   

For each source do the following:

```java
  List<PKMediaSource> mediaSourceList = new ArrayList<>();
  PKMediaSource pkMediaSource = new PKMediaSource();
  pkMediaSource.setId(<FileId>);
  pkMediaSource.setUrl(<Media URL>);
  pkMediaSource.setMediaFormat(PKMediaFormat.getMediaFormat(<Media URL));
  
  mediaSourceList.add(mediaSource); 
```

> Note: In case of Widevine Media, a DRM license is required.

```java
  List<PKDrmParams> pkDrmDataList = new ArrayList<>();
  PKDrmParams pkDrmParams = new PKDrmParams(licenseUrl);
  pkDrmDataList.add(pkDrmParams);
  pkMediaSource.setDrmData(pkDrmDataList);
```

### Create the Media Entry  

For each entry, do the following:
  
```java
  PKMediaEntry mediaEntry = new PKMediaEntry();
  mediaEntry.setId(<MediaId>)
  mediaSourceList.add(pkMediaSource);
  mediaEntry.setSources(mediaSourceList);
  mediaEntry.setDuration(mediaDuration);

```

**When the PKMediaEntry is ready, you can begin configuring the player.**


## Session Provider

The SessionProvider interface defines the base requirements for implementing an element that enables access to a remote data source by the player's components.

Components such as Media Providers and some of the OVP plugins that need to connect to the remote data source and request actions, get data, and update date, work with the SessionProvider.

The SessoinProvider provides the following:

1 . A Base url - This is the domain name of the designated remote host.
  _**The Base url should only contain the host domain name and should not include
   a path to the services within.**_

 _Example:_
  
```java
  OVP base url: https://cdnapisec.kaltura.com/
```

2 . A Session Token - This is a valid session key to work against the data source.

3 . PartnerId - The partner that was used to create the session token.

>Note: You can create your own SessionProvider implementation or use the provided SDK implementations.


## Creating a SessionProvider  

There are a number of options for creating a SessionProvider:

### Self Implemented

You can create a SessionProvider using an anonymous interface instantiation or implementing a class.


```java
SessionProvider sessionProvider = new SessionProvider() {
            @Override
            public String baseUrl() {
                return baseUrl;
            }

            @Override
            public void getKs(OnCompletion<PrimitiveResult> completion) {
                completion.onComplete(new PrimitiveResult(getKs()));
            }

            @Override
            public int partnerId() {
                return partnerId();
            }
        };
```

### Provided Implementation

You can create a SessionProvider using the existing OttSessionProvider or OvpSessionProvider providerrs.

#### OttSessionProvider  

The [OttSessionProvider](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/backend/phoenix/OttSessionProvider.java) supports anonymous and user-specific session creation, on the Kaltura Phoenix Backend.

* The Anonymous session starts with the "ottUser/anonymousLogin" API.
* User specific session starts with the "ottUser/login" API, according to the username and password.

The provider handles the refreshes of the session token when needed, before the token expires, and renews the session if it expires.
Upon every session token fetching request, the session provider checks the current token validity; if the token has expired and can be renewed, the provider renews the token.

A user session can be ended by making the session token invalid. This  means that additional requests using that token will fail.
Once a session has ended it can't be renewed, and a new session should be started.

To end a session, use the "ottUser/logout" API.

An anonymous session can't be ended Until the session token (KS) expires.

After a session has started, the SessionProvider is ready and can be used as a parameter for media providers and other components.

**Using the OttSessionProvider**

To use the OttSessionProvider, implement the following:

```java
    OttSessionProvider ottSessionProvider = new OttSessionProvider(PhoenixBaseUrl, partnerId);
    ottSessionProvider.startSession(username, password, udid, new OnComplition<PrimitiveRersult>(){
     @Override
        public void onComplete(PrimitiveResult response) {
            if(response.isSuccess()) { // has valid session:

                phoenixMediaProvider = new PhoenixMediaProvider()
                              .setSessionProvider(ottSessionProvider)
                              .setReferenceType(APIDefines.AssetReferenceType.Media)
                              .setAssetId(ChannelId)
                              .setFormats(FormatHD, FormatSD);

                phoenixMediaProvider.load(new OnMediaLoadCompletion() {
                    @Override
                    public void onComplete(ResultElement<PKMediaEntry> response) {
                      ...
                    }
                });

            } else { // error: session creation failed
              ErrorElement error = response.getError();
            }
        }
    });
```

#### OvpSessionProvider  

The [OvpSessionProvider](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/backend/ovp/OvpSessionProvider.java) supports anonymous and user-specific session creation on Kaltura's OVP Backend.

* A anonymous session starts with the "session/startWidgetSession" API.
* A user specific session starts with the "user/loginByLoginId" API

By default a session is valid for 24 hours. Once expired, the OvpSessionProvider will try to renew the session.

A user session can be ended by making the session token invalid. This  means that additional requests using that token will fail.
Once a session has ended it can't be renewed, and a new session should be started.

To end a session, use the "session/end" API.

> Note: An anonymous session can't be ended. Until the session token (KS) expires the token can be used.

After a session starts, the SessionProvider is ready and can be used as a parameter for media providers and other components.


**Using the OvpSessionProvider**

To use the OvpSessionProvider, implement the following:

```java
      OvpSessionProvider ovpSessionProvider = new OvpSessionProvider(OvpBaseUrl);
      ovpSessionProvider.startAnonymousSession(partnerId, new OnComplition<PrimitiveRersult>(){
       @Override
          public void onComplete(PrimitiveResult response) {
              if(response.isSuccess()) { // has valid session:

                  kalturaOvpMediaProvider = new KalturaOvpMediaProvider()
                                .setSessionProvider(ovpSessionProvider)
                                .setEntryId(EntryId);

                  kalturaOvpMediaProvider.load(new OnMediaLoadCompletion() {
                      @Override
                      public void onComplete(ResultElement<PKMediaEntry> response) {
                        ...
                      }
                  });

              } else { // error: session creation failed
                ErrorElement error = response.getError();
              }
          }
      });
```

## UIConf Provider

==TBD==


## Have Questions or Need Help?

Check out the [Kaltura Player SDK Forum](https://forum.kaltura.org/c/playkit) page for different ways of getting in touch.
