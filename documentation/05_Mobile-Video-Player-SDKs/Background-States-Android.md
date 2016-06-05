---
layout: page
title: Android Background State Handling
subcat: Android
weight: 200
---

This article describes how to save the Player state when the application moves to the background, which can occur in a number of situations. The application is designed to handle a number of background states, including:

* The end user tapped the Home button.
* The end user pressed the power button.
* Viewing was interrupted by a telephone call or similar interruption.

## Background State: Home Button and Phone Call Interuption  

1. In the onPause() method, call: `mPlayer.releaseAndSavePosition(boolean shouldRestoreState)`. 
Use `true` if you want to save the state and  `false` if you want to go back to the pause state.
2. In the onResume() method, call : `mPlayer.resumePlayer()`

## Background State: Power Button  

1. In the onPause() method, call : `mPlayer.pause()`
2. In the onResume() method, call: `play()` or `pause()`, depending on the application's behavior.
