---
layout: page
title: Controlling audio output on iOS with AVAudioSession
subcat: iOS
weight: 290
---

[![iOS](https://img.shields.io/badge/iOS-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios) 

This article describes the steps required to add support for controlling audio output in iOS devices.

## In order to play sound even silent switch is off, do as follows:

When you start play the video
1. Keep initial category value of AVAudioSession aside
2. Change actual category value to AVAudioSessionCategoryPlayback

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
