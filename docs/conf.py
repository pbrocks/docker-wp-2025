# ./docs/conf.py
# -- Project information -----------------------------------------------------

project = "Docker WP 2025"
copyright = """2025, The API Guys"""
author = "The API Guys"

html_theme = 'sphinx_rtd_theme'

extensions = ['sphinx.ext.autodoc']

exclude_patterns = ["_build", "Thumbs.db", ".DS_Store"]

# Path to static files (such as CSS)
html_static_path = ['_static']

# Add custom CSS file
html_css_files = [
    'added.css',  # This file should be in the _static directory
]
