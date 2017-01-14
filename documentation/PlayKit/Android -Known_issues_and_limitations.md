---
layout: page
title: Known Issues and Limitations in Android Devices
subcat: SDK 3.0 (Beta) - Android
weight: 411
---

[![Android](https://img.shields.io/badge/Android-Supported-green.svg)](https://github.com/kaltura/playkit-android)

The follwoing known issues and limitations are applicable to Android devices.

**Black screen blinking when using the player in Fragment** 

There is a well known issue using Android [SurfaceView](https://developer.android.com/reference/android/view/SurfaceView.html) inside Fragment. You can see this in stackoverflow [here](http://stackoverflow.com/questions/8772862/surfaceview-flashes-black-on-load/12636285#12636285). 

When the surface view appears in the window for the very fist time, it requests to change the window's parameters by calling a private IWindowSession.relayout(..) method. This method "gives" the user a new frame, window, and window surface, which are empty at this stage. 

Our solution is as follows: 

1. Add the following line of code to the root activity that is actually responsible for creating the Player Fragment:

  ```
  @Override
    protected void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);
        getWindow().setFormat(PixelFormat.TRANSLUCENT);
        setFragments();
    }
  ```

2. Then, call the following:

  ```
  getWindow().setFormat(PixelFormat.TRANSLUCENT);
  ```

 immediately after the super.onCreate(savedInstanceState); But before this line: 

 ```
 setContentView();
 ```

This will make the surfaceView translucent until the layout is actually created.
