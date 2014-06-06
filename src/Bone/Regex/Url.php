<?php

namespace Bone\Regex;

class Url
{
    const CONTROLLER = '^\/(?<controller>[^\/]+)';
    const CONTROLLER_ACTION = '^\/(?<controller>[^\/]+)\/(?<action>[^\/]+)';
    const CONTROLLER_ACTION_VARS = '^\/(?<controller>[^\/]+)\/(?<action>[^\/]+)\/(?<varvalpairs>(?:[^\/]+\/[^\/]+\/?)*)';
    const URL_MANDATORY_PARAM = '(\/:\w+)';
    const URL_OPTIONAL_PARAM = '(\[\/:\w+\])';
    const SQUARE_BRACKETS = '\[(\X+)\]';
    const SLASH_WORD = '(\/\w+)';
}