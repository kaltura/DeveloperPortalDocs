---
layout: page
title: Getting Started with Kaltura's Video Player SDK for Android
subcat: SDK 3.0 (Beta) - Android
weight: 291
---

This article will help you get started with the development of Kaltura's Video Player SDK for Android.

## Before You Begin  

This document describes the steps required for integrating the Playkit SDK in Android applications. 

Please follow these instructions carefully to make sure the integration is successful. The article also shows you how to create a  [player](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/Player.java) using [PlayerConfig](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/PlayerConfig.java). 

In addition, you'll also learn how to receive a PlayerConfig.Media object with the help of the built-in [MockMediaProvider](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/backend/mock/MockMediaProvider.java).

By following these simple steps, you'll be able to create your own player and start using it immediately. 

## System Requirements  

To integrate the Kaltura Player Android SDK, the minimum system requirements are:

* IDE: Android Studio 2.0 or later (see developer.android.com/sdk)
* OS version: Android 4.1 or later.
* Java JDK 7 or later (see www.oracle.com/downloads)
* Android SDK and Android SDK Tools

### Developer Skills  

Developers should have some background knowledge and experience with system setup before building Mobile SDK applications. 

The required developer skillsets includes:
* Familiarity with video delivery formats, ad delivery, DRM (when needed), login and passcode flows (these are essential for designing and debugging Mobile SDK applications).
* At least 1-2 years of experience with the relative coding language Java (for Android development)
* Hybrid requirement: Proficiency in HTML5 and JavaScript languages.


## Known Issues and Limitations

The follwoing known issues and limitations are applicable to Android devices.

**Black screen blinking when using the player in Fragment** 

There is a well known issue using Android [SurfaceView](https://developer.android.com/reference/android/view/SurfaceView.html) inside Fragment. You can see this in stackoverflow [here](http://stackoverflow.com/questions/8772862/surfaceview-flashes-black-on-load/12636285#12636285). 

When the surface view appears in the window for the very fist time, it requests to change the window's parameters by calling a private IWindowSession.relayout(..) method. This method "gives" the user a new frame, window, and window surface, which are empty at this stage. 

Our solution is as follows: 

1 . Add the following line of code to the root activity that is actually responsible for creating the Player Fragment:

```java
  @Override
    protected void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);
        getWindow().setFormat(PixelFormat.TRANSLUCENT);
        setFragments();
    }
```

2 . Then, call the following:

```java
  getWindow().setFormat(PixelFormat.TRANSLUCENT);
```

 immediately after the super.onCreate(savedInstanceState); But before this line: 

```java
 setContentView();
```

This will make the surfaceView translucent until the layout is actually created.


## Quick Start

In this section, you'll learn how to build a basic video playback application using the Kaltura Player SDK for Android.


[Android Quick Start]()


</br>
## Have Questions or Need Help?

Check out the [Kaltura Player SDK Forum](https://forum.kaltura.org/c/playkit) page for different ways of getting in touch.
