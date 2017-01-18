---
layout: page
---

# Player Config

Player configuration is the main data object of the Mobile SDK. 

This object is used for configuring custom player, including spesific plugins and obtaining the media that will be played on the device.

> Note: For Technical Documantion About [PlayerConfig](https://kaltura.github.io/playkit/api/ios/Classes/PlayerConfig.html)

### Create PlayerConfig Instance

>swift

```swift
let config = PlayerConfig()

```
>objc

```obc
PlayerConfig *config = [PlayerConfig new];

```

>Note: To Initialize Player Config `MediaEntry` is needed. 

## Media Entry

The MediaEntry can be created using one of the following methods:

Manually - Instantiate a new PKMediaEntry instance and fill the fields.

Using a MockMediaProvider - Create a PKMediaEntry from a JSON input file or JsonObject.

Using a remote media provider - Use one of the provided MediaEntryProvider implementations: For OVP environments, use `KalturaOvpMediaProvider`. For OTT environments, use `PhoenixMediaProvider`.

Once you have a `MediaEntry` ready, you can build the player configuration and plugins, and continue to prepare the Kaltura Mobile Video Player for play.

> Note: For Technical Documantion About [PlayerConfig](https://kaltura.github.io/playkit/api/ios/Classes/MediaEntry.html)

**Having Issues?**

> We have a [Questions and Answer Forum](https://forum.kaltura.org/c/playkit) where you can ask your iOS Development questions.