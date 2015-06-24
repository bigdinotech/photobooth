
import pygame
import os
import sys
import RPi.GPIO as GPIO
from pygame.locals import *
from time import sleep

#gpio
GPIO.setmode(GPIO.BCM)
GPIO.setup(23, GPIO.IN)
GPIO.setup(24, GPIO.IN)
GPIO.setup(25, GPIO.IN)

#pygame
WIDTH=1280
HEIGHT=720
FONTSIZE=500
pygame.init()
screen = pygame.display.set_mode((WIDTH,HEIGHT))
black = pygame.Color(0, 0, 0)
textcol = pygame.Color(255, 255, 0)
screen.fill(black)
pygame.mouse.set_visible(0)
font = pygame.font.Font('freesansbold.ttf', FONTSIZE)
pygame.mixer.init(48000, -16, 1, 1024)

def readbutton():
    btn = 0
    if(GPIO.input(23) == False):
        btn = 1
    if(GPIO.input(24) == False):
        btn = 2
    #if(GPIO.input(25) == False):
    #    btn = 3
    return btn
    
def displayText(text, font_size, t, l):
    font = pygame.font.Font('freesansbold.ttf', font_size)
    font_surf = font.render(text, True, textcol)
    font_rect = font_surf.get_rect()
    font_rect.left = l
    font_rect.top = t
    screen.blit(font_surf, font_rect)
    pygame.display.flip()
    return

screen.fill(black)  
#wait for button press before taking photos
choice = 0
while (readbutton() != 1):
    sleep(0.1)

# TAKE 4 photos 
screen.fill(black)
screenTxt = 'Get Ready!!!'
displayText(screenTxt, 150, 0, 200)
sleep(5)    
counter = 0
while (counter < 4):
    counter += 1
    countdown = 7
    while (countdown > 0):
        countdown -= 1
        screen.fill(black)
        if(countdown ==1):
            screenTxt = 'Please stay still'
            lpos = 50
            tpos = 600
            displayText(screenTxt, 50, tpos, lpos)
            screenTxt = 'smile'
            lpos = 0
            tpos = 150
        elif(countdown == 0):
            #take photo using gphoto
            filename = 'image' + str(counter) + '.jpg'
            #camera.capture(filename)
            command = 'gphoto2 --capture-image-and-download --filename ' + filename
            os.system(command)
        elif(countdown > 1):
            pygame.mixer.music.load("beep.mp3")
            pygame.mixer.music.play()
            screenTxt = str(countdown)
            lpos = 475
            tpos = 150
        displayText(screenTxt, FONTSIZE, tpos, lpos)
        sleep(1)
#combine and display image into one photo

#read counter file
imageCounter = 0
file = open('counter', 'r+')
imageCounter = int(file.readline())
imageCounter += 1
file.seek(0)
file.write(str(imageCounter))
file.close()

os.system('sudo ./assembleSimple')
montageName = 'nsdphotobooth' + str(imageCounter) + '.jpg'
command = 'mv temp_montage2.jpg ' + montageName
os.system(command)
img = pygame.image.load(montageName)
img = pygame.transform.scale(img, (1108, 720))
screen.fill(black)
screen.blit(img, (0, 0))
pygame.display.flip()

#cleanup
os.system('chmod +x image*.jpg')
os.system('rm image*.jpg')

# CLOSE CLEANLY AND EXIT
pygame.quit()

