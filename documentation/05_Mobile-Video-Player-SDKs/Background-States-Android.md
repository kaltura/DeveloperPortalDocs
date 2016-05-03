---
layout: page
title: Android Background State Handling
subcat: Android
---

This article describes how to save the Player state when the application moves to the background, which can occur when the end user taps the home button, presses the power button, or as the result of a telephone call.

## Background State Handling
The application should handle a number of background states:

1. The end user tapped the Home button.
2. The end user pressed the power button.
3. Viewing was interrupted by a telephone call or similar interruption.

# Home Button and Phone Call Interuption
In the onPause() method, call: `mPlayer.releaseAndSavePosition(boolean shouldRestoreState)`

Use `true` if you want to save the state and  `false` if you want to go back to the pause state.

In the onResume() method, call : `mPlayer.resumePlayer()`


# Power Button
In the onPause() method, call : `mPlayer.pause()`

In the onResume() method, call: `play()` or `pause()`, depending on the application's behavior.
