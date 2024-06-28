# Use an appropriate base image
FROM nginx:latest

# Copy custom Nginx configuration file
COPY nginx.conf /etc/nginx/nginx.conf

# Remove default configuration symlink
RUN rm /etc/nginx/conf.d/default.conf

# Expose ports if necessary (port 80 for HTTP and port 443 for HTTPS)
EXPOSE 80
EXPOSE 443

# Command to run Nginx
CMD ["nginx", "-g", "daemon off;"]
