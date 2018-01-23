---
layout: page
---

## Tracks Selection Mode

This document describes how to use track selection modes in the player.

>Note: Track selection modes are available for audio and text tracks only!

### Available Modes and Behavior

There are three available track selection modes:

* Off - Off, which is the default mode, means different things for text selection and audio selection: for text selection, Off means the player will use the default value from the playlist. For audio select, the player will simply turn audio selection off.
* Auto - In this mode, the player selects the language by the device locale if available; if not, it takes the default selection from the stream instead (if there is one).
* Selection - This mode uses a specific selection, where you'll need to provide the specific selection you'd like to use.

#### Text Track Selection  

>swift

```swift
player.settings.trackSelection.textSelectionMode = // .off/.auto/.selection
// use text selection language when using '.selection' mode.
player.settings.trackSelection.textSelectionLanguage = // en/fr...
```

>objc

```objc
player.settings.trackSelection.textSelectionMode = // TrackSelectionModeOff/TrackSelectionModeAuto/TrackSelectionModeSelection
// use text selection language when using 'TrackSelectionModeSelection' mode.
player.settings.trackSelection.textSelectionLanguage = // en/fr...
```

#### Audio Track Selection

>swift

```swift
player.settings.trackSelection.audioSelectionMode = // .off/.auto/.selection
// use text selection language when using '.selection' mode.
player.settings.trackSelection.audioSelectionLanguage = // en/fr...
```

>objc

```objc
player.settings.trackSelection.audioSelectionMode = // TrackSelectionModeOff/TrackSelectionModeAuto/TrackSelectionModeSelection
// use text selection language when using 'TrackSelectionModeSelection' mode.
player.settings.trackSelection.audioSelectionLanguage = // en/fr...
```

## Code Samples

Go to [PlayKit iOS Samples](https://github.com/kaltura/playkit-ios-samples/tree/master) for code samples.

## Have Questions or Need Help?  

Check out the [Kaltura Player SDK Forum](https://forum.kaltura.org/c/playkit) page for different ways of getting in touch.
