import os
import environ


env = environ.Env()

BASE_DIR = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))

SECRET_KEY = env(
    'DJANGO_SECRET_KEY',
    default='local-secret-key'
    )

DEBUG = env.bool('DJANGO_DEBUG', False)

ALLOWED_HOSTS = ['legacydapp.com', 'www.legacydapp.com', ]
if DEBUG:
    ALLOWED_HOSTS += ['localhost', 'local', '127.0.0.1', ]


INSTALLED_APPS = [
    'djangocms_admin_style',
    'django.contrib.admin',
    'django.contrib.auth',
    'django.contrib.contenttypes',
    'django.contrib.sessions',
    'django.contrib.messages',
    'django.contrib.staticfiles',
    'django.contrib.sites',
]
THIRD_PARTY_APPS = [
    'phonenumber_field',
    'allauth',
    'allauth.account',
    'allauth.socialaccount',
    'allauth.socialaccount.providers.google',
    'django_extensions',
    # 'django_eth_events',
    'django_eth',
]

INTERNAL_APPS = [
    'capsules',
    'support',
    'users',
    'plugins',
]

INSTALLED_APPS += THIRD_PARTY_APPS + INTERNAL_APPS

if DEBUG:
    INSTALLED_APPS += [
        'debug_toolbar',
    ]

MIDDLEWARE = [
    'django.middleware.security.SecurityMiddleware',
    'django.contrib.sessions.middleware.SessionMiddleware',
    'django.middleware.common.CommonMiddleware',
    'django.middleware.csrf.CsrfViewMiddleware',
    'django.contrib.auth.middleware.AuthenticationMiddleware',
    'django.contrib.messages.middleware.MessageMiddleware',
    'django.middleware.clickjacking.XFrameOptionsMiddleware',
    'debug_toolbar.middleware.DebugToolbarMiddleware',
]

ROOT_URLCONF = 'legacy.urls'

TEMPLATES = [
    {
        'BACKEND': 'django.template.backends.django.DjangoTemplates',
        'DIRS': [
            os.path.join(BASE_DIR, 'templates'),
        ],
        'APP_DIRS': True,
        'OPTIONS': {
            'context_processors': [
                'django.template.context_processors.debug',
                'django.template.context_processors.request',
                'django.contrib.auth.context_processors.auth',
                'django.contrib.messages.context_processors.messages',
            ],
        },
    },
]

WSGI_APPLICATION = 'legacy.wsgi.application'


# Database
# https://docs.djangoproject.com/en/2.0/ref/settings/#databases

DATABASES = {
    'default': env.db('DATABASE', default='postgres:///legacy'),
}

# Password validation
# https://docs.djangoproject.com/en/2.0/ref/settings/#auth-password-validators

AUTH_PASSWORD_VALIDATORS = [
    {
        'NAME': 'django.contrib.auth.password_validation.UserAttributeSimilarityValidator',
    },
    {
        'NAME': 'django.contrib.auth.password_validation.MinimumLengthValidator',
    },
    {
        'NAME': 'django.contrib.auth.password_validation.CommonPasswordValidator',
    },
    {
        'NAME': 'django.contrib.auth.password_validation.NumericPasswordValidator',
    },
]

# Internationalization
# https://docs.djangoproject.com/en/2.0/topics/i18n/

LANGUAGE_CODE = 'en-us'

TIME_ZONE = 'Europe/Paris'

USE_I18N = True

USE_L10N = True

USE_TZ = True

PHONENUMBER_DB_FORMAT = 'E164'

# Static files (CSS, JavaScript, Images)
# https://docs.djangoproject.com/en/2.0/howto/static-files/

STATIC_URL = '/static/'
STATIC_ROOT = os.path.join(BASE_DIR, 'static_root')

STATICFILES_DIRS = [
    os.path.join(BASE_DIR, 'static'),
]

INTERNAL_IPS = [
    '127.0.0.1',
]

MEDIA_ROOT = os.path.join(BASE_DIR, 'upload')

# User model and (all)Auth Stuff

AUTH_USER_MODEL = 'users.User'
LOGIN_REDIRECT_URL = 'home'
LOGOUT_REDIRECT_URL = 'home'

AUTHENTICATION_BACKENDS = (
    "django.contrib.auth.backends.ModelBackend",
    "allauth.account.auth_backends.AuthenticationBackend",
)

ACCOUNT_AUTHENTICATION_METHOD = ("email")
ACCOUNT_EMAIL_REQUIRED = True
ACCOUNT_USERNAME_REQUIRED = False

SITE_ID = 1

APPEND_SLASH = False

ADMINS = [('errors', 'errors@legacydapp.com'), ('legacy admins', 'admins@chainimpact.io')]
MANAGERS = ADMINS

DEFAULT_FROM_EMAIL = 'message@legacydapp.com'

# email + sendgrid
EMAIL_BACKEND = "sendgrid_backend.SendgridBackend"

# EMAIL_HOST = env('EMAIL_HOST', default='smtp.sendgrid.net')
# EMAIL_PORT = env('EMAIL_PORT', default='587')
# EMIAL_HOST_USER = env('EMIAL_HOST_USER', default='sendgrid_username')
# EMAIL_HOST_PASSWORD = env('EMAIL_HOST_PASSWORD', default='sendgrid_password')
# EMAIL_USE_TLS = True
SENDGRID_API_KEY = env('SENDGRID_API_KEY', default='sendgrid_api_key')
SENDGRID_SANDBOX_MODE_IN_DEBUG = False

# BEHOLD THE HOLY LOGS
LOGGING_FILE = '{}'.format(
    '/tmp/legacy.log' if DEBUG
    else '/var/log/legacy/legacy.log')

LOGGING = {
    # OTHER OPTIONS
    "version": 1,
    "disable_existing_loggers": False,
    'filters': {
        # OTHER FILTERS
        'require_debug_false': {
            '()': 'django.utils.log.RequireDebugFalse'
        }
    },
    'handlers': {
        # OTHER HANDLERS
        'file': {
            'level': 'INFO',
            'class': 'logging.FileHandler',
            'filename': LOGGING_FILE,
        },
        'mail_admins': {
            'level': 'ERROR',
            # 'filters': ['require_debug_false'],
            'class': 'django.utils.log.AdminEmailHandler',
            'include_html': True
        },
        'console': {
            'class': 'logging.StreamHandler',
        },
    },
    'loggers': {
        # OTHER LOGGERS
        'management_commands': {
            'handlers': ['console', 'mail_admins', ],
            'level': 'ERROR',
            'propagate': True,
        },
        'django': {
            'handlers': ['file', 'console', ],
            'level': 'INFO',
            'propagate': True,
        },
    }
}

# ETHEREUM_NODE_URL = os.environ['HTTP://127.0.0.1:7545']
ETHEREUM_NODE_URL = 'HTTP://127.0.0.1:7545'
# ETHEREUM_MAX_WORKERS = os.environ['ETHEREUM_MAX_WORKERS']
ETHEREUM_MAX_WORKERS = 3

# TODO: webjs provider
# WEB3_HTTP_PROVIDER = env('WEB3_HTTP_PROVIDER', default='https://rinkeby.infura.io')
