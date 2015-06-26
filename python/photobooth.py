
import picamera
from time import sleep
from datetime import datetime
import pygame
import os
import RPi.GPIO as GPIO
from pygame.locals import *
import socket
import re
import sys
from twython import Twython
import smtplib
from email.MIMEMultipart import MIMEMultipart
from email.MIMEBase import MIMEBase
from email.MIMEText import MIMEText
from email.Utils import COMMASPACE, formatdate
from email import Encoders

#gmail
USERNAME = "nsdphotobooth@gmail.com"
PASSWORD = "nsdphoto"

#twitter
CONSUMER_KEY = 'L6oV0Jhv4AxxWmliIlpuOKvFq'
CONSUMER_SECRET = 'aSihiiHhVDopnySUSDimi6u4fov47kQgc8LJJQ3gW49niVosyE'
ACCESS_KEY = '2849802708-N5MJkJ4j2stDgOJE68UDxoI0CJIIFxyUyuupdrV'
ACCESS_SECRET = 'XRt15tEBjyzI8uNMTfBJCWZvXZbAX0q7quYgIsfjvoD2G' 
api = Twython(CONSUMER_KEY,CONSUMER_SECRET,ACCESS_KEY,ACCESS_SECRET) 

#gpio
GPIO.setmode(GPIO.BCM)
GPIO.setup(23, GPIO.IN)
GPIO.setup(24, GPIO.IN)
GPIO.setup(25, GPIO.IN)

# INIT CAMERA
camera = picamera.PiCamera()
camera.vflip = False
camera.hflip = False
camera.resolution = (854, 480)
camera.framrate = (24, 1)
camera.preview_alpha = 90
camera.brightness = 50
camera.contrast = 25
camera.sharpess = 0
camera.shutter_speed = 500000

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

REMOTE_SERVER = "www.google.com"
EMAIL_REGEX = re.compile(r"\w[\w\.-]*@\w[\w\.-]+\.\w+")

#functions
def is_connected():
  try:
    # see if we can resolve the host name -- tells us if there is
    # a DNS listening
    host = socket.gethostbyname(REMOTE_SERVER)
    # connect to the host -- tells us if the host is actually
    # reachable
    s = socket.create_connection((host, 80), 2)
    return True
  except:
     pass
  return False

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
    
def getUserEmail(txtIn, prompt):
    font = pygame.font.Font('freesansbold.ttf', 50)
    screen.fill(black)
    pygame.display.flip()
    txtIn = ''
    while True:
        for evt in pygame.event.get():
            if evt.type == KEYDOWN:
                if evt.unicode.isalpha():
                    txtIn += evt.unicode
                elif evt.key == K_BACKSPACE:
                    txtIn = txtIn[:-1]
                elif evt.key == K_RETURN:
                    if(EMAIL_REGEX.match(txtIn)):
                        return txtIn
                    else:
                        screenTxt = 'invalid email entered!!!'
                        displayText(screenTxt, 50, 600, 0)
                        pygame.display.flip()
                        sleep(3)
                else:
                    txtIn += evt.unicode
        screen.fill((0, 0, 0))
        font_surf = font.render(prompt, True, textcol)
        font_rect = font_surf.get_rect()
        font_rect.left = 100
        font_rect.top = 0
        screen.blit(font_surf, font_rect)
        block = font.render(txtIn, True, (255, 255, 255))
        rect = block.get_rect()
        rect.center = screen.get_rect().center
        screen.blit(block, rect)
        pygame.display.flip()
    return

def getUserInput(txtIn, prompt):
    font = pygame.font.Font('freesansbold.ttf', 50)
    screen.fill(black)
    pygame.display.flip()
    txtIn = ''
    while True:
        for evt in pygame.event.get():
            if evt.type == KEYDOWN:
                if evt.unicode.isalpha():
                    txtIn += evt.unicode
                elif evt.key == K_BACKSPACE:
                    txtIn = txtIn[:-1]
                elif evt.key == K_RETURN:
                    return txtIn
                else:
                    txtIn += evt.unicode
        screen.fill((0, 0, 0))
        font_surf = font.render(prompt, True, textcol)
        font_rect = font_surf.get_rect()
        font_rect.left = 100
        font_rect.top = 0
        screen.blit(font_surf, font_rect)
        block = font.render(txtIn, True, (255, 255, 255))
        rect = block.get_rect()
        rect.center = screen.get_rect().center
        screen.blit(block, rect)
        pygame.display.flip()
    return
    
def tweetPhoto(imageFileName, tweetMsg):
    photo = open(imageFileName, 'rb')
    api.update_status_with_media(media=photo, status=tweetMsg)
    return
    
def sendMail(to, subject, text, files=[]):
    assert type(to)==list
    assert type(files)==list
 
    msg = MIMEMultipart()
    msg['From'] = USERNAME
    msg['To'] = COMMASPACE.join(to)
    msg['Date'] = formatdate(localtime=True)
    msg['Subject'] = subject
    
    msg.attach( MIMEText(text) )
 
    for file in files:
        part = MIMEBase('application', "octet-stream")
        part.set_payload( open(file,"rb").read() )
        Encoders.encode_base64(part)
        part.add_header('Content-Disposition', 'attachment; filename="%s"'
                       % os.path.basename(file))
        msg.attach(part)
 
    server = smtplib.SMTP('smtp.gmail.com:587')
    server.ehlo_or_helo_if_needed()
    server.starttls()
    server.ehlo_or_helo_if_needed()
    server.login(USERNAME,PASSWORD)
    server.sendmail(USERNAME, to, msg.as_string())
    server.quit()
    return
            
run = 1;
while (True):
    #display preview
    camera.start_preview()
    screen.fill(black)
    pygame.display.flip()
    camera.annotate_text = 'please press yes to take photos'
    
    
    #wait for button press before taking photos
    choice = 0
    while (readbutton() != 1):
        sleep(0.1)
        
    # TAKE 4 photos 
    screen.fill(black)
    screenTxt = 'Get Ready!!!'
    displayText(screenTxt, 150, 0, 200)
    sleep(5)
    camera.annotate_text = ''
    counter = 0
    while (counter < 4):
        counter += 1
        countdown = 6
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
                filename = 'image' + str(counter) + '.jpg'
                camera.capture(filename)
                pygame.mixer.music.load("camera.mp3")
                pygame.mixer.music.play()
            elif(countdown > 1):
                pygame.mixer.music.load("beep.mp3")
                pygame.mixer.music.play()
                screenTxt = str(countdown)
                lpos = 475
                tpos = 150
            displayText(screenTxt, FONTSIZE, tpos, lpos)
            sleep(1)
        
    #combine the images into 1
       
    #read counter file
    imageCounter = 0
    file = open('counter', 'r+')
    imageCounter = int(file.readline())
    imageCounter += 1
    file.seek(0)
    file.write(str(imageCounter))
    file.close()
    
    #combine and display image into one photo
    screen.fill(black)
    pygame.display.flip()
    pygame.mixer.music.load("takeoff.mp3")
    pygame.mixer.music.play()
    camera.annotate_text = 'Stitching photos. Please wait'
    os.system('sudo ./assemble')
    camera.stop_preview()
    montageName = 'nsdphotobooth' + str(imageCounter) + '.jpg'
    command = 'mv temp_montage2.jpg ' + montageName
    os.system(command)
    img = pygame.image.load(montageName)
    img = pygame.transform.scale(img, (1108, 720))
    screen.fill(black)
    screen.blit(img, (0, 0))
    pygame.display.flip()
    
    #print photos
    command = 'lp -d Canon_CP900 ' + montageName
    os.system(command)
    
    #email Photo
    screen.fill(black)
    img = pygame.image.load(montageName)
    img = pygame.transform.scale(img, (1108, 720))
    screen.blit(img, (0, 0))
    screenTxt = 'Would you like the photo emailed to you?'
    displayText(screenTxt, 50, 0, 50)
    pygame.display.flip()
    choice = 0
    while (choice == 0):
        choice = readbutton()
        sleep(0.1)
    if(choice == 1):
        email = ''
        email = getUserEmail(email, 'Please enter email to send the photo to')
        #make sure email address is in valid format
        if(is_connected()):
            mailBody = 'Photos from the NSD Year End Celebration 2014.\n\n Twitter Photos: https://twitter.com/nsdphotobooth'
            screen.fill(black)
            screenTxt = 'Emailing Photo'
            displayText(screenTxt, 50, 0, 50)
            sendMail( [email], "Tardis nsdphotobooth", mailBody,[montageName] )
            #command = 'mpack -s "NSDphotobooth auto emailer" ' + montageName + ' ' + email + ' &'
            #os.system(command)
        else:
            #save filename and email address for batch email later on
            screen.fill(black)
            screenTxt = 'Photos will be emailed to you at a later time'
            displayText(screenTxt, 50, 0, 50)
            sleep(3)
        file = open('maillist', 'a')
        file.write(montageName + ', ' + email + '\n')
        file.close()
            
    #tweet Photo
    screen.fill(black)
    img = pygame.image.load(montageName)
    img = pygame.transform.scale(img, (1108, 720))
    screen.blit(img, (0, 0))
    screenTxt = 'Would you like to tweet this photo?'
    displayText(screenTxt, 50, 0, 50)
    pygame.display.flip()
    choice = 0
    while (choice == 0):
        choice = readbutton()
        sleep(0.1)
    if(choice == 1):
        if(is_connected()):
            tweetMsg = ''
            tweetMsg = getUserInput(tweetMsg, 'Please enter tweet')
            screen.fill(black)
            screenTxt = 'Tweeting...'
            displayText(screenTxt, 50, 0, 50)
            tweetPhoto(montageName, tweetMsg)
            
    #display printing message
    screen.fill(black)
    img = pygame.image.load(montageName)
    img = pygame.transform.scale(img, (1108, 720))
    screen.blit(img, (0, 0))
    screenTxt = 'Your photo is being printed. Please collect the photo outside.'
    displayText(screenTxt, 40, 0, 0)
    pygame.display.flip()
    sleep(5)
    
    
    run = 0
# CLOSE CLEANLY AND EXIT
camera.close()
pygame.quit()
