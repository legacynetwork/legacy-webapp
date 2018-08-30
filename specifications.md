# legacy dapp base specifications:

## goals and functionalities:
Build a decentralised application that sends messages with files to contacts once a dead man switch is activated.

## User types:
admin
user


## navigation structure:

legacydapp.com
├── user
│   ├── signin
│   └── signup
└── app.legacy.com
    ├── profile
    ├── contacts
    ├── services
    ├── proof of life
    └── memories


## main functionalities:

### user
- singup
- signin
- signout
- reset password
- change password
- delete account

### profile
- view profile
	- first name
	- last name
	- addr
	- addr eth
	- telephone
	- numero secu
	- email
	- email2
- modify profile info
- view user settings
- modify user settings
- referral email

### capsules
- list capsules
- view capsule detail
- create capsule
- delete capsule
- modify capsule

### files
- upload file(s) to account
- attach files to capsule
- detach files from capsule
- delete file
- uplaod file to fileservice (Siacoin, Filecoin, IPFS, etc...)
- get hash of file

### contacts
- create contact
- delete contact
- modify contact
- assign contact to capsule
- change capsule settings

### services:
- list services
- add service key
- check service availability
- remote check if service had connection
- remove service key

### view overall legacy state
- % of services triggered


## django apps and models:

- users
	- User
    - UserSettings
    - Person
- capsules
    - Capsule
    - CapsuleSettings
- memories
    - Memory
    - https://github.com/jeffbr13/django-ipfs-storage
- plugins
    - Plugin
- core?
- eth_events (https://github.com/gnosis/django-eth-events, https://github.com/gnosis/django-eth)
- app_events 
- file_events (https://github.com/jeffbr13/django-ipfs-storage)
