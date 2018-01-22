---
layout: page
---

## Tracks Selection Mode

This document describes how to use tracks selection modes.

>Note: Tracks selection modes are available for audio and text tracks only!

### Available Modes and Behavior

There are 3 available modes:

1. Off - the default mode, in this mode audio takes the default selection and text if off.
2. Auto - Selects the language by the device locale if available, if not takes the default selection from the stream instead (if there is one).
3. Selection - A specific selection, in this mode you provide a specific selection you would like to use.

#### Text Tracks Selection

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

#### Audio Tracks Selection

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

[PlayKit iOS Samples](https://github.com/kaltura/playkit-ios-samples/tree/master), click to go to samples.

## Have Questions or Need Help?

Check out the [Kaltura Player SDK Forum](https://forum.kaltura.org/c/playkit) page for different ways of getting in touch.
