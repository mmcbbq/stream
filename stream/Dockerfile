
FROM ossrs/srs:5

ENV CANDIDATE=127.0.0.1

# Start SRS with the given config and replace the candidate IP dynamically
CMD sed -i "s/__CANDIDATE__/${CANDIDATE}/" /usr/local/srs/conf/rtmp2rtc.conf && \
    ./objs/srs -c /usr/local/srs/conf/rtmp2rtc.conf



