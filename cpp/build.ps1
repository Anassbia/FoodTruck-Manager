param([string]$ConnectorDir = $env:FOODTRUCK_MYSQL_CONNECTOR)
$ErrorActionPreference = 'Stop'
if (-not $ConnectorDir) { $ConnectorDir = Join-Path $PSScriptRoot 'lib\mysql-connector-c++' }
$ConnectorDir = (Resolve-Path -LiteralPath $ConnectorDir).Path
$taskVsWhere = Join-Path ${env:ProgramFiles(x86)} 'Microsoft Visual Studio\Installer\vswhere.exe'
if (-not (Test-Path -LiteralPath $taskVsWhere)) { throw 'Visual Studio 2022 C++ tools are required.' }
$taskInstallations = & $taskVsWhere -products '*' -format json | ConvertFrom-Json
$taskMsBuild = $null
foreach ($taskInstallation in $taskInstallations) {
    $taskCandidate = Join-Path $taskInstallation.installationPath 'MSBuild\Current\Bin\MSBuild.exe'
    $taskCppTools = Join-Path $taskInstallation.installationPath 'VC\Auxiliary\Build\vcvars64.bat'
    if ((Test-Path -LiteralPath $taskCandidate) -and (Test-Path -LiteralPath $taskCppTools)) {
        $taskMsBuild = $taskCandidate
        break
    }
}
if (-not $taskMsBuild) { throw 'Visual Studio C++ tools were not found.' }
$taskBuildDir = Join-Path $PSScriptRoot 'build'
New-Item -ItemType Directory -Path $taskBuildDir -Force | Out-Null
& $taskMsBuild (Join-Path $PSScriptRoot 'PROJET.vcxproj') /nologo /m:2 /v:minimal `
    /p:Configuration=Release /p:Platform=x64 /p:WholeProgramOptimization=false `
    "/p:MySQLConnectorDir=$ConnectorDir" "/p:OutDir=$taskBuildDir/" "/p:IntDir=$taskBuildDir/obj-app/" `
    /p:GenerateDebugInformation=false
if ($LASTEXITCODE -ne 0) { throw "C++ build failed with exit code $LASTEXITCODE." }
Get-ChildItem -LiteralPath (Join-Path $ConnectorDir 'lib64') -Filter '*.dll' -File | Copy-Item -Destination $taskBuildDir
Write-Output "Built $taskBuildDir\PROJET.exe"
