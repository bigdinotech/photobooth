
import pygame
import os
import os.path
import sys
import RPi.GPIO as GPIO
from pygame.locals import *
from time import sleep

#gpio
GPIO.setmode(GPIO.BCM)
GPIO.setup(23, GPIO.IN)
GPIO.setup(24, GPIO.IN)
GPIO.setup(25, GPIO.IN)


def readbutton():
    btn = 0
    if(GPIO.input(23) == False):
        btn = 1
    if(GPIO.input(24) == False):
        btn = 2
    #if(GPIO.input(25) == False):
    #    btn = 3
    return btn
run = 1;
while (run):    
    message = 'Press Yes button to start taking photos and No button to exit'
    print message
    choice = 0
    while (choice == 0):
        choice = readbutton()
        sleep(0.1)
    if(choice == 1):    
    # TAKE 4 photos
        sleep(1)
        counter = 0
        while (counter < 4):
            counter += 1
            #wait for button to snap photo
            message = 'Press button to snap a photo'
            print message
            choice = 0
            while (choice == 0):
                choice = readbutton()
                sleep(0.1)
            #take photo using gphoto
            filename = 'image' + str(counter) + '.jpg'
            command = 'gphoto2 --capture-image-and-download --filename ' + filename
            os.system(command)
            if(os.path.isfile(filename)):
                message = 'Capture successful'
                print message
            else:
                message = 'Capture failed pls try again'
                print message
                counter -= 1
        #combine and display image into one photo

        #read counter file
        imageCounter = 0
        file = open('counter', 'r+')
        imageCounter = int(file.readline())
        imageCounter += 1
        file.seek(0)
        file.write(str(imageCounter))
        file.close()

        message = 'Stitching photos'
        print message
        #combine and display image into one photo
        os.system('chmod +x image*.jpg')
        os.system('sudo ./assembleSimple')
        montageName = 'nsdphotobooth' + str(imageCounter) + '.jpg'
        command = 'mv temp_montage2.jpg ' + montageName
        os.system(command)

        message = 'Photo saved as ' + montageName + '\n\n'
        print message
        command = 'xdg-open ' + montageName
        os.system(command)

        #print photo
        message = 'Print Photo?'
        print message
        choice = 0
        while (choice == 0):
            choice = readbutton()
            sleep(0.1)
        if(choice == 1):
            command = 'lp -d Canon_CP900 ' + montageName
            os.system(command)


        #cleanup
        os.system('rm image*.jpg')
    else:
        run = 0
    sleep(1)