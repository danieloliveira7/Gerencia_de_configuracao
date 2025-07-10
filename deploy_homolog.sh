#!/bin/bash

echo "🚀 Deploy para PRODUÇÃO iniciado..."

git checkout main
git pull origin main
git merge develop
git push origin main

echo "✅ Deploy para PRODUÇÃO concluído!"