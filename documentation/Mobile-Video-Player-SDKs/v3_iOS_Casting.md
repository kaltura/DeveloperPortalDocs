---
layout: page
title: Configuring Casting on iOS Devices
subcat: SDK 3.0 (Beta) - iOS
weight: 502
---

The following casting schemes are supported on iOS devices:

<center>

|                                         |      About      | Sample |
|:---------------------------------------:|:---------------:|:------:|
| ![help](./v3-images/iOS/airPlay.png)    | [AirPlay](https://github.com/kaltura/DeveloperPortalDocs/blob/mobilePlayerSDKV3/documentation/Mobile-Video-Player-SDKs/v3_iOS_Casting.md#airplay)     | [x]()  |
| ![help](./v3-images/iOS/chromecast.png) | [Google Cast](https://github.com/kaltura/DeveloperPortalDocs/blob/mobilePlayerSDKV3/documentation/Mobile-Video-Player-SDKs/v3_iOS_Casting.md#google-cast) | [x]()  |            |

</center>

</br>
## Airplay  

This article describes the steps required for adding support for the AirPlay functionality on iOS devices. AirPlay (developed by Apple Inc.) enables wireless streaming of audio, video, photos and more between devices.

### Add the AirPlay Functionality  

1. Enable the Audio, Airplay, and Picture in the Picture background mode. 
2. In Xcode 8, select a target, and then under Capabilities > Background Modes, enable **Audio, Airplay and Picture in Picture**. 

	![AirPlay Functionality](./v3-images/iOS/EnableAirPlay.png) 

3. Import MediaPlayer, create an `MPVolumeView`, and then add it to your view as follows: 

> swift  

```swift
let airPlayBtn = MPVolumeView(frame: CGRect(x: 0, y: 0, width: 44, height: 44))
airPlayBtn.showsVolumeSlider = false
container.addSubview(airPlayBtn)

```
>objc

```objc


```

**Optional:** Customize the image of the AirPlay button as follows: 

> swift  

```swift
airPlayBtn.setRouteButtonImage(UIImage(named: "name"), for: UIControlState.normal)

```

>objc

```objc


```

## Adding Support for Google Cast on iOS devices.

This article describes how to add support for Google Cast on iOS devices.

###  Install Google Cast  

Add the following to your pod file: 

```ruby
pod "PlayKit/GoogleCastAddon", :git => 'https://github.com/kaltura/playkit-ios.git', :tag => PLAYKIT_TAG.

```

###  Import the Required Files  

Next, import the following:

> swift  

```swift
import GoogleCast
import PlayKit
```

>objc

```objc


```
	
> Note: For example, to reach the GCKGoogleCastContext you'll need the - import `GoogleCast`. To reach OVP/OTT-CastBuilder you'll need the - import `PlayKit`.


###  Casting  

To begin casting, you'll need to create a `GCKMediaInformation` by using a CastBuilder - either `OVPCastBuilder` or `TVPAPICastBuilder`.


#### Example of Casting Using OVPCastBuilder  

> swift  

```swift
do {
	var media: GCKMediaInformation? = nil
	media = try OVPCastBuilder()
                    .set(ks: ks)
                    .set(contentId: entryId)
                    .set(adTagURL: adTagURL)
                    .set(uiconfID: uiconfId)
                    .set(partnerID: partnerId)
                    .set(metaData: metaData)
                    .build()

	if let m = media {
                self.load(mediaInformation: m)    
            }
	}catch{
            print(error)
	}

```
>objc

```objc


```


#### Example of Casting Using TVPAPICastBuilder

> swift  

```swift
	do {
	var media: GCKMediaInformation? = nil
 	media = try TVPAPICastBuilder()
                    .set(contentId: entryId)
                    .set(uiconfID: uiconfId)
                    .set(partnerID: partnerId)
                    .set(metaData: metaData)
                    .set(initObject: initObject)
                    .set(format: format)
                    .build()

	if let m = media {
                self.load(mediaInformation: m)    
            }
	}catch{
            print(error)
	}
```
>objc

```objc


```

### Loading Media  

Next, use the loadmedia to load the required media:

> swift  

```swift
private func load(mediaInformation:GCKMediaInformation) -> Void {
    let session =  GCKCastContext.sharedInstance().sessionManager.currentCastSession
    if let currentSession = session,  
    	let remoteMediaClient = currentSession.remoteMediaClient {
            remoteMediaClient.loadMedia(mediaInformation, autoplay: true)
        }
 	}

```
>objc

```objc


```

### Custom Data

To add custom data:

> swift  

```swift
private func customData(mediaMetaData: MediaMetadataData?) ->  GCKMediaMetadata {
        
        let metaData = GCKMediaMetadata(metadataType: GCKMediaMetadataType.movie)
        if let title = mediaMetaData?.title {
            metaData.setString(title, forKey: kGCKMetadataKeyTitle)
        }
        
        if let subtitle = mediaMetaData?.subtitle {
            metaData.setString(subtitle, forKey: kGCKMetadataKeySubtitle)
        }
        
        if let images = mediaMetaData?.imageUrls {
            
        for image in images {
                
                guard let urlString = image.URL,
                    let url = URL(string:urlString),
                    let sheight = image.height,
                    let swidth = image.width,
                    let width = Int(swidth),
                    let hight = Int(sheight)
                    else {
                        continue
                }
                
                metaData.addImage(GCKImage(url:url , width:width , height:hight))
            }
        }
        
        return metaData
        
   	 }

```
>objc

```objc


```
	
##  Adding Support for Advertisements on Casted Media    

To add support for advertisments:

1. Add an ad tag URL to the cast builder as follows:

	> swift  

	```swift
	media = try OVPCastBuilder()
	...
	.set(adTagURL: gcAddonData.params?.adTagURL)
	...
	.build()

	```
	>objc

	```objc


	```

2. Next, set the adInfoParserDelegate in the remoteMediaClient to AdInfoParser (a class from the PlayKit) as follows:

	>swift

	```swift
	private func load(mediaInformation:GCKMediaInformation) -> Void {
		let session =  GCKCastContext.sharedInstance().sessionManager.currentCastSession
		if let currentSession = session,  let remoteMediaClient = currentSession.remoteMediaClient {
		    remoteMediaClient.loadMedia(mediaInformation, autoplay: true)
		    //add the following raw
		    remoteMediaClient.adInfoParserDelegate = AdInfoParser.shared
		}
	    }
	```
	>objc

	```objc


	```


</br>
## Have Questions or Need Help?

Check out the [Kaltura Player SDK Forum](https://forum.kaltura.org/c/playkit) page for different ways of getting in touch.

