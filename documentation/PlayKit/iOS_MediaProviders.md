---
layout: page
title: Setting Up Media Providers for iOS Devices
subcat: iOS Version 3.0
weight: 296
---
### How to send a item to play with PlayKit?

## Create a Media-Entry 

In order to get a mediaEntry you should use MediaEntryProvider
There is 3 options for MediaEntryProvider:

1. MockMediaProvider
2. OTTMediaProvider
3. OVPMediaProvider

Each provider has it's own input params according to it's backend.


### MockMediaProvider

The Input of MockMediaProvider is json, for ex':

```
{
        "entryId": {
            "duration": 60000,
            "id": "entryId",
            "name": "demo1",
            "sources": [
                        {
                        "id": "m001s001",
                        "mimeType": "application/dash+xml",
                        "url": "http://cfvod.kaltura.com/dasha/p/1851571/sp/185157100/serveFlavor/entryId/0_pl5lbfo0/v/2/flavorId/0_,zwq3l44r,otmaqpnf,ywkmqnkg,/forceproxy/true/name/a.mp4.urlset/manifest.mpd"
                        }
                        ]
        }
}

```

Initialize the mockMediaProvider :

```
 let mediaProvider1 : MediaEntryProvider = MockMediaEntryProvider()
            .set(content: self.fileContent)
            .set(id: "entryId")
```



### OTTMediaProvider

The Input of OTTMediaProvider is:

1. session provider - which provids all information regarding session. for ex' ks, partnerId, server base url 
2. mediaId - the media to play id 
3. type - is it media or EPG
4. file formats to play - which file you accepts to play. ( HD,SD etc' )


```
let provider = OTTMediaProvider()
        .set(sessionProvider: sessionProvider)
        .set(mediaId: mediaID)
        .set(type: AssetType.media)
        .set(formats: ["Mobile_Devices_Main_HD"])
```

### OVPMediaProvider

The Input of the OVPMediaProvider is:

1. session provider - which provids all information regarding session. for ex' ks, partnerId, server base url 
2. entryId - The entry to play id
3. apiServerURL - base server url, for example: 
 

```
let provider = OVPMediaProvider()
        .set(sessionProvider: sessionProvider)
        .set(entryId: self.entryID)
```


### load the media :
In order to get the mediaEntry you should call the "load" method.

```
 provider.loadMedia { (r:Result<MediaEntry>) in
            if (r.error != nil){
                print(r.error)
            }else{
                print(r)
            }
        }
```
	



