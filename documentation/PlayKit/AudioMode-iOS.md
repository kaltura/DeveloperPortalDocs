---
layout: page
title: Controlling the Audio Output on iOS Devices Using AVAudioSession
subcat: iOS
weight: 290
---

[![iOS](https://img.shields.io/badge/iOS-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios) 


AvAudioSession enables you to control the audio on iOS devices even when the silent switch is off. This article describes the steps required to enable you to control the audio output in iOS devices using AVAudioSession.

## Set AVAudioSession to Play Audio  

The AVAudioSession enables you to play audio (essentially any sound) even when the silent switch is off.

To implement this option:

1. When you begin playing the video, keep the initial category value of AVAudioSession aside.
2. Change the actual category value to AVAudioSessionCategoryPlayback as follows:

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

**Note:** When the video is finished, you may return the initial category value as follows:
```
if let _ = audioSessionInitialCategory {
   do {
        try AVAudioSession.sharedInstance().setCategory(audioSessionInitialCategory!)
   } catch {
   }
}
```
