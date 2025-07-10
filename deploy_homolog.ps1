Write-Host "🚀 Deploy para HOMOLOGAÇÃO iniciado..."

git checkout develop
git pull origin develop
git merge integration
git push origin develop

Write-Host "✅ Deploy para HOMOLOGAÇÃO concluído!"
