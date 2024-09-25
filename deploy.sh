STAGE="$1"
REGION="$2"

sls deploy -s $STAGE -r $REGION

result=$(aws lambda get-function-configuration --function-name draivi-task-$STAGE-health --query 'Environment.Variables' --output json --region $REGION)
WEB_BUCKET_NAME=$(echo "$result" | grep -o '"WEB_BUCKET_NAME": *"[^"]*"' | sed 's/"WEB_BUCKET_NAME": *"\([^"]*\)"/\1/')
API_GW_URL=$(echo "$result" | grep -o '"API_GW_URL": *"[^"]*"' | sed 's/"API_GW_URL": *"\([^"]*\)"/\1/')
WEBPAGE_URL=$(echo "$result" | grep -o '"WEBPAGE_URL": *"[^"]*"' | sed 's/"WEBPAGE_URL": *"\([^"]*\)"/\1/')

sed -i.bak 's|\"https://[^ ]*\.execute-api\.[^ ]*\.amazonaws\.com/[^ ]*\"|\"'"$API_GW_URL"'\"|g' "./web/index.html"
rm "./web/index.html.bak"

sed -i.bak "s|<.*>|<${WEBPAGE_URL}>|g" "./README.md"
rm "./README.md.bak"

aws s3 cp ./web s3://$WEB_BUCKET_NAME/ --recursive