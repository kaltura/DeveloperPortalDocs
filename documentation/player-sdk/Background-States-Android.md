---
layout: page
title: Android Background State Hadling
---

In this document we'll talk about how to save the player state when the app will move to backgorund, This can be due to home button pressed, power button or phone call.
##Background State Hadling

The app should handle few background states:

1. User clicked on home button.
2. User pressed on power button.
3. Phone call interuption and more...

#Home button and Phone call interuption

In the onPause() method you should call : `mPlayer.releaseAndSavePosition(boolean shouldRestoreState)`
Should use `true` if you want to save the state and use `false` if you want to get back in pause state.

In the onResume() method you should call : `mPlayer.resumePlayer()`


#Power Button

In the onPause() method you should call : `mPlayer.pause()`

In the onResume() method you should call: `play()` or `pause()` depends on the app behaviour.
