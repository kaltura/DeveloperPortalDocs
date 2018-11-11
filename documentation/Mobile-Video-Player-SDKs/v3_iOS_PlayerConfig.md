---
layout: page
---

## Player Configuration  

The player configuration is the main data object of the Mobile Video Player SDK. 

This object is used for configuring custom players, including specific plugins, and obtaining the media that will be played on the device.

> Note: To view additional information about the player configuration, see the [Player Config API documentation](https://kaltura.github.io/playkit/api/ios/core/Classes/PlayerConfig.html).

### Creating a PlayerConfig Instance  


>swift

```swift
let config = PlayerConfig()

```
>objc

```obc
PlayerConfig *config = [PlayerConfig new];

```

>Note: To initialize the player configuration, you'll need a `MediaEntry`. 

### About the Media Entry

The MediaEntry can be created using one of the following methods:

* Manually, by instatiating a new `PKMediaEntry` instance and filling the fields.
* Using a `MockMediaProvider` to create a `PKMediaEntry` from a JSON input file or JsonObject.
* Using a remote media provider, provided the `MediaEntryProvider` implementations: 
  * For OVP environments, use `KalturaOvpMediaProvider`
  * For OTT environments, use `PhoenixMediaProvider`

Once you have a `MediaEntry` ready, you can build the player configuration and plugins, and continue to prepare the Kaltura Mobile Video Player for play.

> Note: To view additional information about the Media Entry, see the [Player Config API documentation](https://kaltura.github.io/playkit/api/ios/core/Classes/MediaEntry.html).


## Have Questions or Need Help?

Check out the [Kaltura Player SDK Forum](https://forum.kaltura.org/c/playkit) page for different ways of getting in touch.

