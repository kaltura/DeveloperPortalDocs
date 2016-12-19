---
layout: page
title: Controlling the Audio Output on iOS Devices Using AVAudioSession
subcat: iOS
weight: 290
---

[![iOS](https://img.shields.io/badge/iOS-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios) 

This article describes the steps required to enable you to control the audio output in iOS devices using AVAudioSession.

To play sounds even when the silent switch is off:

When you begin playing the video: 

1. Keep the initial category value of AVAudioSession aside.
2. Change the actual category value to AVAudioSessionCategoryPlayback.

```
var audioSessionInitialCategory: String?

//-----

audioSessionInitialCategory = AVAudioSession.sharedInstance().category
do {
    try AVAudioSession.sharedInstance().setCategory(AVAudioSessionCategoryPlayback)
} catch {
    audioSessionInitialCategory = nil
}
```

When video is finished, put back the initial category value
```
if let _ = audioSessionInitialCategory {
   do {
        try AVAudioSession.sharedInstance().setCategory(audioSessionInitialCategory!)
   } catch {
   }
}
```
