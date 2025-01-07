# Start from an official Python image
FROM python:3.12-slim

# Set working directory
WORKDIR /docs

# Install Sphinx and other dependencies
RUN pip install --upgrade pip && \
    pip install sphinx && \
    pip install sphinx_rtd_theme && \
    pip install sphinx-autobuild 

# Copy the current folder contents into the container
COPY . .

# Establish variable from .env
ARG DOCS_PORT
ENV DOCS_PORT=${DOCS_PORT}

# Expose the port the app runs on
EXPOSE ${DOCS_PORT}

CMD sphinx-autobuild . _build --host 0.0.0.0 --port ${DOCS_PORT} && uvicorn sphinx_autobuild.server:app --host 0.0.0.0 --port ${DOCS_PORT}
 