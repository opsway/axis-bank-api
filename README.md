# axis-bank-api
API SDK for AXIS Bank https://www.axisbank.com/

# Run docker container for developing and testing
Build container with library
```
docker build -t "axis-bank-php" .
```
Start container
```
docker run -it --rm -v /${PWD}:/app axis-bank-php bash
```