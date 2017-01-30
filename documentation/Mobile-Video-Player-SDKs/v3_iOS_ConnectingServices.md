---
layout: page
title: Connecting Services
subcat: SDK 3.0 (Beta) - iOS
weight: 320
---

This article describes how to connect to the Kaltura Backend.

## Create a Media-Entry 

To create a media entry, you'll need to use a Media Entry provider. Choose from the following three Media Entry providers:

* MockMediaProvider
* OTTMediaProvider
* OVPMediaProvider

Each provider has its own input parameters according to its backend.

### MockMediaProvider  

The input of the MockMediaProvider is JSON, for example:

```json
	{
        "entryId": {
            "duration": 60000,
            "id": "entryId",
            "name": "demo1",
            "sources": [
                        {
                        "id": "m001s001",
                        "mimeType": "application/dash+xml",
                        "url": 	"http://cfvod.kaltura.com/dasha/p/1851571/sp/185157100/serveFlavor/entryId/0_pl5lbfo0/v/2/flavorId/0_,zwq3l44r,otmaqpnf,ywkmqnkg,/forceproxy/true/name/a.mp4.urlset/manifest.mpd"
                        }
                        ]
        }
		}

```

To initialize the mockMediaProvider use:

>swift

```swift
let mediaProvider1 : MediaEntryProvider = MockMediaEntryProvider()
.set(content: self.fileContent)
.set(id: "entryId")

```
>objc

```objc


```

### OTTMediaProvider

The input of the OTTMediaProvider is:

* session provider - Provides all information regarding the session, for example the KS, partnerId, server base url, etc. 
* mediaId - The ID of the media to play
* type - Indicates whether this is media or EPG
* file formats to play - Indicates which files are acceptable to play (HD,SD etc' )

>swift

```swift
let provider = OTTMediaProvider()
.set(sessionProvider: sessionProvider)
.set(mediaId: mediaID)
.set(type: AssetType.media)
.set(formats: ["Mobile_Devices_Main_HD"])

```
>objc

```objc


```

### OVPMediaProvider

The input of the OVPMediaProvider is:

* session provider - Provides all information regarding the session, for example the KS, partnerId, server base url, etc.
* entryId - The ID of the entry to play
* apiServerURL - The base server url, for example: 

>swift

```swift
let provider = OVPMediaProvider()
.set(sessionProvider: sessionProvider)
.set(entryId: self.entryID)

```
>objc

```objc


```

## Loading Media  

To get the MediaEntry, you'll need to call the "load" method as follows:

>swift

```swift
 provider.loadMedia { (r:Result<MediaEntry>) in
  		if (r.error != nil){
          print(r.error)
       }else{
          print(r)
        }
  }

```
>objc

```objc


```


</br>
## Have Questions or Need Help?

Check out the [Kaltura Player SDK Forum](https://forum.kaltura.org/c/playkit) page for different ways of getting in touch.
